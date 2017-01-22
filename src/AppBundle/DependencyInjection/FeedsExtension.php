<?php

namespace AppBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Extension\Extension;

class FeedsExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();

        $config = $this->processConfiguration($configuration, $configs);

        foreach ($config['items'] as $code => $item) {
            $feedBuilderDefinition = new Definition($item['builder']);
            $feedBuilderDefinition->addArgument($item['base_uri']);
            $feedBuilderDefinition->addArgument($item['suffix']);

            $container->setDefinition(sprintf('app.feed_builder.%s', $code), $feedBuilderDefinition);
        }
    }
}
