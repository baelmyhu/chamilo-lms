<?php

/* For licensing terms, see /license.txt */

declare(strict_types=1);

namespace Chamilo\CoreBundle;

<<<<<<< HEAD
use Symfony\Component\HttpKernel\Bundle\Bundle;

class ChamiloCoreBundle extends Bundle {}
=======
use Chamilo\CoreBundle\DependencyInjection\Compiler\PluginEntityPass;
use Chamilo\CoreBundle\DependencyInjection\Compiler\PluginEventSubscriberPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class ChamiloCoreBundle extends Bundle
{
    public function build(ContainerBuilder $container): void
    {
        parent::build($container);

        $container
            ->addCompilerPass(new PluginEventSubscriberPass())
            ->addCompilerPass(new PluginEntityPass())
        ;
    }
}
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
