<?php

namespace Knp\Bundle\MenuBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;

class KnpMenuExtension extends Extension
{
    /**
     * Handles the landmarx_landmark configuration.
     *
     * @param array $configs The configurations being loaded
     * @param ContainerBuilder $container
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('landmark.yml');

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        foreach ($config['providers'] as $builder => $enabled) {
            if ($enabled) {
                $container->getDefinition(sprintf('landmarx_landmark.landmark_provider.%s', $builder))->addTag('landmarx_landmark.provider');
            }
        }

        if (isset($config['twig'])) {
            $loader->load('twig.xml');
            $container->setParameter('landmarx_landmark.renderer.twig.template', $config['twig']['template']);
        }
        if ($config['templating']) {
            $loader->load('templating.xml');
        }

        $container->setParameter('landmarx_landmark.default_renderer', $config['default_renderer']);
    }
}
