<?php

/*
 * This file is part of the Widop package.
 *
 * (c) Widop <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\PhpBBBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder,
    Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Widop PhpBB configuration.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('widop_php_bb');

        $rootNode
            ->children()
                // Absolute path to the phpBB root dir
                ->scalarNode('path')->isRequired()->end()     

                // Relative path to the phpBB dir. Relative from /web. Used to generate Urls
                ->scalarNode('web_path')->isRequired()->end() 
            ->end();

        return $treeBuilder;
    }
}
