<?php

namespace LADR\SmsBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class LADRSmsExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $BCBreakParams = array(
            'ladr_sms.api_key' => 'api_key',
            'ladr_sms.sms_type' => 'sms_type'
        );

        foreach ($BCBreakParams as $keyToReplace => $newKey) {
            if ($container->hasParameter($keyToReplace)) {
                trigger_error(sprintf(
                    'The "%s" container parameter is deprecated. You should move this parameter in your config.yml file under the "%s" config, with the new key "%s".',
                    $keyToReplace, 'ladr_sms', $newKey
                ), E_USER_DEPRECATED);

                if (!isset($configs['ladr_sms'][$newKey])) {
                    $configs['ladr_sms'][$newKey] = $container->getParameter($keyToReplace);
                }
            }
        }

        $config = $this->processConfiguration(new Configuration(), $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        foreach ($config as $key => $value) {
            $container->setParameter('ladr_sms.'.$key, $value);
        }
    }

    public function getAlias()
    {
        return 'ladr_sms';
    }
}
