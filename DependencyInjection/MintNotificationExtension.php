<?php

namespace KisztoF\NotificationBundle\DependencyInjection;

use KisztoF\NotificationBundle\Producer\PushNotificationProducer;
use OldSound\RabbitMqBundle\OldSoundRabbitMqBundle;
use Symfony\Bundle\MonologBundle\MonologBundle;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class MintNotificationExtension extends Extension implements PrependExtensionInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');

        $container->setParameter('kisztof_notification.monolog.channel', $config['monolog']['channel']);
    }

    /**
     * Allow an extension to prepend the extension configurations.
     *
     * @param ContainerBuilder $container
     */
    public function prepend(ContainerBuilder $container)
    {
        $connection = $container->getExtensionConfig('kisztof_notification')[0]['rabbit']['connection'];

        if (in_array(OldSoundRabbitMqBundle::class, $container->getParameter('kernel.bundles'))) {
            $config = [
                'producers' => [
                    'kisztof_notification_send_push' => [
                        'connection' => $connection,
                        'class' => PushNotificationProducer::class,
                        'exchange_options' => ['name' => 'kisztof-notification-send-push', 'type' => 'direct', 'durable' => true],
                    ],
                ],
            ];
            $container->prependExtensionConfig('old_sound_rabbit_mq', $config);
        }

        $monologChannel = $container->getExtensionConfig('kisztof_notification')[0]['monolog']['channel'];
        if (in_array(MonologBundle::class, $container->getParameter('kernel.bundles'))) {
            $config = [
                'channels' => [$monologChannel],
            ];
            $container->prependExtensionConfig('monolog', $config);
        }
    }
}
