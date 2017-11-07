<?php

namespace Goth\EzPlatformSoundCloudFieldTypeBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Config\Resource\FileResource;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class GothEzPlatformSoundCloudFieldTypeExtension extends Extension implements PrependExtensionInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('fieldtypes.yml');
    }

    /**
     * @param ContainerBuilder $container
     */
    public function prepend(ContainerBuilder $container)
    {
        $this->prependPlatform($container);
        $this->prependYui($container);
    }

    /**
     * @return array
     */
    public function getTranslationDomains() : array
    {
        return array('goth_soundcloud');
    }

    /**
     * @param ContainerBuilder $container
     */
    private function prependPlatform(ContainerBuilder $container)
    {
        $config = Yaml::parse(file_get_contents(__DIR__.'/../Resources/config/ezplatform.yml'));
        $container->prependExtensionConfig('ezpublish', $config);
    }

    /**
     * @param ContainerBuilder $container
     */
    private function prependYui(ContainerBuilder $container)
    {
        $container->setParameter(
            'goth_soundcloud_fieldtype.public_dir',
            'bundles/gothezplatformsoundcloudfieldtype'
        );

        $yuiConfigFile = __DIR__ . '/../Resources/config/yui.yml';
        $config = Yaml::parse(file_get_contents($yuiConfigFile));
        $container->prependExtensionConfig('ez_platformui', $config);
        $container->addResource(new FileResource($yuiConfigFile));
    }
}
