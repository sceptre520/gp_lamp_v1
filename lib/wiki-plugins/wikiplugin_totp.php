<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id$

use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use PragmaRX\Google2FA\Google2FA;

function wikiplugin_totp_info()
{
    return [
        'name'          => tra('Time-based One-time Password'),
        'documentation' => 'PluginTOTP',
        'description'   => tra(
            'Allows to generate Time-based One-time Password'
        ),
        'prefs'         => ['wikiplugin_totp'],
        'extraparams'   => true,
        'validate'      => 'all',
        'params'        => [
            'secret'   => [
                'required'    => false,
                'name'        => tra('Secret'),
                'description' => tra(
                    'Secret key required to generate time-based one-time passwords'
                ),
            ],
            'interval' => [
                'required'    => false,
                'name'        => tra('Interval'),
                'description' => tra(
                    'Amount of seconds that a TOTP will be valid/refreshed'
                ),
            ],
            'issuer'   => [
                'required'    => false,
                'name'        => tra('Issuer'),
                'description' => tra(
                    'Name of the application where the generated time-based one-time password will be use.'
                ),
            ],
        ],
    ];
}

function wikiplugin_totp($data, $params)
{
    global $user, $page;

    $sourcePerm = TikiLib::lib('tiki')->user_has_perm_on_object(
        $user,
        $page,
        'wiki page',
        'tiki_p_wiki_view_source'
    );
    $editPerm = TikiLib::lib('tiki')->user_has_perm_on_object(
        $user,
        $page,
        'wiki page',
        'tiki_p_edit'
    );
    $viewPerm = TikiLib::lib('tiki')->user_has_perm_on_object(
        $user,
        $page,
        'wiki page',
        'tiki_p_view'
    );
    if (! $viewPerm) {
        return;
    }
    $headerlib = TikiLib::lib('header');
    $headerlib->add_jsfile(
        'vendor_bundled/vendor/npm-asset/zxing--library/umd/index.min.js'
    );
    $headerlib->add_jsfile('lib/jquery_tiki/wikiplugin-totp.js', true);

    $tikilib = TikiLib::lib('tiki');
    $info = $tikilib->get_page_info($page, true, true);
    $defaults = [
        'interval'   => 30,
        'issuer'     => 'Unknown Application',
        'id'         => uniqid(),
        'sourcePerm' => $sourcePerm,
    ];
    $params = array_merge($defaults, $params);

    if (
        ! isset($params['secret']) && isset($_REQUEST['action'])
        && $_REQUEST['action'] == 'add_totp'
        && isset($_REQUEST['secret'])
    ) {
        $defaults = [
            'period' => 30,
            'issuer' => 'Unknown Application',
        ];
        $data = array_merge($defaults, $_REQUEST);
        addTOTPPlugin(
            $page,
            $user,
            $data['secret'],
            $data['period'],
            $data['issuer']
        );
        echo json_encode([]);
        die;
    }

    if (! isset($params['secret'])) { //try to request camera and id not possible show a form
        if (! $editPerm) {
            return;
        }
        $smarty = TikiLib::lib('smarty');
        $smarty->assign($params);
        $html = $smarty->fetch('wiki-plugins/wikiplugin_totp_scanner.tpl');
        $html = preg_replace('/(\v|\s)+/', ' ', $html);
        return '~np~' . html_entity_decode($html, ENT_HTML5, 'utf-8') . '~/np~';
    }

    $secretKey = $params['secret'];

    if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'get_code') {
        $google2fa = new Google2FA();
        echo json_encode(
            [
                'code'     => $google2fa->getCurrentOtp($secretKey),
                'interval' => $params['interval'],
            ]
        );
        die;
    }

    $smarty = TikiLib::lib('smarty');
    $smarty->assign(
        'tfaSecretQR',
        getSecretQR($secretKey, $params['interval'], $user, $params['issuer'])
    );
    $smarty->assign($params);
    $html = $smarty->fetch('wiki-plugins/wikiplugin_totp.tpl');
    $html = preg_replace('/(\v|\s)+/', ' ', $html);
    return '~np~' . html_entity_decode($html, ENT_HTML5, 'utf-8') . '~/np~';
}

function getSecretQR($secretKey, $interval, $user, $issuer)
{
    $google2fa = new Google2FA();
    $google2fa->setKeyRegeneration($interval);
    $g2faUrl = $google2fa->getQRCodeUrl(
        $issuer,
        $user,
        $secretKey
    );

    if (extension_loaded('imagick')) {
        $imageBackEnd = new ImagickImageBackEnd();
        $imageType = 'png';
    } else {
        $imageBackEnd = new SvgImageBackEnd();
        $imageType = 'svg+xml';
    }

    $writer = new Writer(
        new ImageRenderer(
            new RendererStyle(350),
            $imageBackEnd
        )
    );
    $tfaSecretQR = base64_encode($writer->writeString($g2faUrl));
    return '<img src="data:image/' . $imageType . ';base64,'
        . $tfaSecretQR . '"/>';
}

function addTOTPPlugin($pageName, $user, $secret, $interval, $issuer)
{

    $widget = sprintf(
        '{totp secret="%s" interval="%s" issuer="%s"}',
        $secret,
        $interval,
        $issuer
    );

    $re = '/{totp(\s+\}|\})/mi';

    $tikilib = TikiLib::lib('tiki');
    $info = $tikilib->get_page_info($pageName, true, true);
    $data = $info['data'];
    $parserlib = TikiLib::lib('parser');
    $parserlib->plugins_remove($data, $noparsed);

    $noparsed['data'] = array_map(
        function ($item) use ($parserlib, $widget) {
            $plugins = $parserlib->getPlugins($item);
            if (
                ! empty($plugins) && ! empty($plugins[0])
                && count($plugins[0]) == 5
                && strtolower($plugins[0][1]) == 'totp'
                && empty($plugins[0]['arguments'])
            ) {
                return $widget;
            }
            return $item;
        },
        $noparsed['data']
    );

    $parserlib->plugins_replace($data, $noparsed);
    $tikilib->update_page(
        $pageName,
        $data,
        tra('TOTP added'),
        $user,
        $tikilib->get_ip_address()
    );

    return true;
}
