<?php

namespace Victoire\Widget\ImageBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 */
class Configuration implements ConfigurationInterface
{
    /**
     * Load the configuration tree builder.
     *
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $treeBuilder->root('victoire_image');

        return $treeBuilder;
    }
}
