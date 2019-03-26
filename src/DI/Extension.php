<?php

declare(strict_types=1);

namespace FileJet\Nette\DI;

use Nette;

class Extension extends Nette\DI\CompilerExtension
{
    private $defaults = [
        'filterName' => 'replace_images',
        'lazyLoadAttribute' => 'data-src',
        'basePath' => null
    ];

    public function loadConfiguration()
    {
        $config = $this->getConfig($this->defaults);
        $builder = $this->getContainerBuilder();

        $builder
            ->addDefinition($this->prefix('filejet'))
            ->setType('FileJet\External\ReplaceHtml')
            ->setArguments([
                'storageId' => $config['storageId'],
                'lazyLoadAttribute' => $config['lazyLoadAttribute'],
                'basePath' => $config['basePath']
            ]);

        if ($builder->hasDefinition('nette.latteFactory')) {
            $definition = $builder->getDefinition('nette.latteFactory');
            $definition->addSetup(
                'addFilter',
                [
                    $config['filterName'],
                    [$this->prefix('@filejet'), 'replaceImages']
                ]
            );

            $definition->addSetup(
                'addFilter',
                [
                    $config['filterName']."_url",
                    [$this->prefix('@filejet'), 'prefixImageSource']
                ]
            );


        }
    }
}