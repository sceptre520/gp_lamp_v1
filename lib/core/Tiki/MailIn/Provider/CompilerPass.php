<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: CompilerPass.php 78605 2021-07-05 14:54:45Z rjsmelo $

namespace Tiki\MailIn\Provider;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

class CompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (! $container->hasDefinition('tiki.mailin.providerlist')) {
            return;
        }

        $definition = $container->getDefinition('tiki.mailin.providerlist');

        $taggedServices = $container->findTaggedServiceIds('tiki.mailin.provider');
        foreach ($taggedServices as $id => $attributes) {
            $definition->addMethodCall('addProvider', [
                new Reference($id),
            ]);
        }
    }
}
