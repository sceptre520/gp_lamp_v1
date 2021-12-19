<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id$

namespace Tiki\Lib\OpenIdConnect;

use CoderCat\JWKToPEM\JWKConverter;
use OpenIDConnectClient\AccessToken;
use OpenIDConnectClient\OpenIDConnectProvider;

class OpenIdConnectLib
{
    protected $clientSecret;

    protected $clientId;

    protected $issuer;

    protected string $redirectUri;

    protected $authUrl;

    protected $accessTokenUrl;

    protected $detailsUrl;

    protected $pbKeyFiles;

    protected $verifyMethod;

    protected $connectCert;

    protected $isAvailable;

    protected OpenIDConnectProvider $provider;

    protected $createUserTiki;

    public function __construct()
    {
        global $prefs, $base_url;

        $this->clientId = $prefs['openidconnect_client_id'];
        $this->clientSecret = $prefs['openidconnect_client_secret'];
        $this->issuer = $prefs['openidconnect_issuer'];
        $this->redirectUri = $base_url . $prefs['login_url'];
        $this->authUrl = $prefs['openidconnect_auth_url'];
        $this->accessTokenUrl = $prefs['openidconnect_access_token_url'];
        $this->detailsUrl = $prefs['openidconnect_details_url'];
        $this->clientId = $prefs['openidconnect_client_id'];
        $this->verifyMethod = $prefs['openidconnect_verify_method'];
        $this->connectCert = $prefs['openidconnect_cert'];
        $this->createUserTiki = $prefs['openidconnect_create_user_tiki'];
        $this->jwksUrl = $prefs['openidconnect_jwks_url'];
        $this->pbKeyFiles = $this->getPublicKeyFiles();
        if (! empty($this->pbKeyFiles) && $this->validatePreferences()) {
            $this->isAvailable = true;
        }
        $this->provider = $this->getProviderInstance();
    }

    protected function getProviderInstance()
    {
        $signer = new RSA256Signer();
        return new OpenIDConnectProvider(
            [
                'clientId'                => $this->clientId,
                'clientSecret'            => $this->clientSecret,
                'idTokenIssuer'           => $this->issuer,
                'redirectUri'             => $this->redirectUri,
                'urlAuthorize'            => $this->authUrl,
                'urlAccessToken'          => $this->accessTokenUrl,
                'urlResourceOwnerDetails' => $this->detailsUrl,
                'publicKey'               => $this->pbKeyFiles,
            ],
            [
                'signer' => $signer,
            ]
        );
    }

    /**
     * @return string
     */
    public function generateURL(): string
    {
        $provider = $this->getProviderInstance();
        if (isset($_SESSION['open_id_state'])) {
            $_SESSION['open_id_state'] = $provider->getState();
        }

        return $provider->getAuthorizationUrl(
            ['scope' => 'openid profile email',
             'state' => $_SESSION['open_id_state']]
        );
    }

    public function isAvailable(): bool
    {
        return $this->isAvailable ?: false;
    }

    public function validatePreferences(): bool
    {
        global $prefs;
        $prefs_keys = [
            'openidconnect_name',
            'openidconnect_issuer',
            'openidconnect_auth_url',
            'openidconnect_access_token_url',
            'openidconnect_client_id',
            'openidconnect_client_secret',
            'openidconnect_verify_method',
        ];
        $valid = true;
        foreach ($prefs_keys as $prefsKey) {
            if (! isset($prefs[$prefsKey])) {
                error_log(
                    '[OpenId Connect error] Field ' . $prefsKey
                    . ' is required.'
                );
                $valid = false;
            }
        }
        return $valid;
    }

    protected function getPublicKeyFiles()
    {
        if ($this->verifyMethod === 'jwks') {
            $pbKeys = $this->getPublicKeyFromJWKS();
        } else {
            $pbKeys[] = $this->connectCert;
        }

        return $pbKeys;
    }

    protected function getPublicKeyFromJWKS()
    {
        try {
            $cachelib = \TikiLib::lib('cache');
            $cacheName = 'oidc' . md5($this->jwksUrl);
            $beginOfDay = new \DateTime();
            $beginOfDay->modify('today'); //Get file one time per day
            $cachedValue = $cachelib->getCached(
                $cacheName,
                '',
                $beginOfDay->getTimestamp()
            );
            if ($cachedValue) {
                $jwkArr = unserialize($cachedValue);
            } else {
                $jwkArr = json_decode(file_get_contents($this->jwksUrl), true);
                $cachelib->cacheItem(
                    $cacheName,
                    serialize(
                        $jwkArr
                    )
                );
            }
        } catch (\Throwable $e) {
            error_log(
                sprintf(
                    '[OpenId Connect error] Error getting JWKS from %s: $s',
                    $this->jwksUrl,
                    $e->getMessage()
                )
            );
            return false;
        }

        try {
            $jwkConverter = new JWKConverter();
            return $jwkConverter->multipleToPEM($jwkArr['keys']);
        } catch (\Throwable $e) {
            error_log(
                sprintf(
                    '[OpenId Connect error] Error converting JWKS to PEM %s: $s',
                    $this->jwksUrl,
                    $e->getMessage()
                )
            );
            return false;
        }
    }

    public function getAccessToken($code): AccessToken
    {
        return $this->provider->getAccessToken(
            'authorization_code',
            [
                'code' => $code,
            ]
        );
    }

    /**
     * @return boolean
     */
    public function canCreateUserTiki(): bool
    {
        return $this->createUserTiki == 'y';
    }
}
