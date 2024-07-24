<?php

use OSW3\Search\Enum\RequestMethods;
use OSW3\Search\Enum\RequestOperators;

return static function($definition)
{
    $definition->rootNode()->children()

        /**
         * Config of the search form
         * 
         * @var null|array
         */
        ->arrayNode('form')->isRequired()->children()

            /**
             * Template of the form
             * 
             * @var null|string
             * @default @Search/form/default.html.twig
             */
            ->scalarNode('template')
                ->defaultValue("@Search/form.html.twig")
            ->end()

            /**
             * Method attribute of the form
             * 
             * @var string
             * @enum GET | POST
             * @default GET
             */
            ->enumNode('method')
                ->values([RequestMethods::toArray()])
                ->defaultValue(RequestMethods::GET->value)
            ->end()

            /**
             * The query param (input name attr)
             * 
             * @var string
             * @default q
             */
            ->scalarNode('parameter')
                ->defaultValue("q")
            ->end()

        ->end()->end()

        /**
         * Config of the results
         * 
         * @var null|array
         */
        ->arrayNode('results')->isRequired()->children()

            /**
             * Template of the results
             * 
             * @var null|string
             * @required
             */
            ->scalarNode('template')->defaultValue("@Search/results.html.twig")->end()


            ->scalarNode('base')->defaultValue("base.html.twig")->end()

            /**
             * Results route
             * 
             * @var null|string
             * @required
             */
            ->scalarNode('route')->defaultValue('search')->end()

        ->end()->end()

        /**
         * Config of the entities
         * 
         * @var null|array
         */
        ->arrayNode('entities')->arrayPrototype()->children()

            /**
             * Template part of the item on results page
             * 
             * @var string
             */
            ->scalarNode('template')->isRequired()->end()
            
            /**
             * Class name to highlight the expression in the result
             */
            ->scalarNode('highlight')->defaultNull()->end()

            /**
             * Template part of the item on results page
             * 
             * @var null|string
             */
            ->scalarNode('alias')->defaultNull()->end()

            /**
             * The route to generate link to show the item
             * 
             * @var null|string
             */
            ->scalarNode('route')->defaultNull()->end()
            
            
            /**
             * Add parameter to the route
             * 
             * @var array
             * @default ['id']
             */
            ->arrayNode('route_parameters')->defaultValue(['id'])->scalarPrototype()->end()->end()


            /**
             * Serializer group
             * 
             * @var null|array
             */
            ->arrayNode('serialize')->scalarPrototype()->end()->end()

            /**
             * Criteria 
             * Used to generate a WHERE clause of the query
             * 
             * @var array
             */
            ->arrayNode('criteria')->arrayPrototype()->children()

                /**
                 * Matching method
                 * 
                 * @var string
                 * @enum 
                 * @default like
                 */
                // ->enumNode('match')
                //     ->values(RequestOperators::toArray())
                //     ->defaultValue(RequestOperators::LIKE->value)
                // ->end()

            ->end()->end()->end()

        ->end()->end()->end()


    ->end();
};