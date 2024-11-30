<?php

use OSW3\Search\Enum\RequestMethods;
use OSW3\Search\Enum\RequestOperators;

return static function($definition)
{
    $definition->rootNode()->arrayPrototype()
        ->info('Provide a configuration settings.')
        ->children()

        ->arrayNode('form')
            ->info('Search form configuration settings.')
            ->addDefaultsIfNotSet()->children()

            ->scalarNode('template')
                ->info('Specifies the path to the template file used to display the search form')
                ->defaultValue("@Search/form/base.html")
            ->end()

        ->end()->end()

        ->arrayNode('request')
            ->info('Search request configuration settings.')
            ->addDefaultsIfNotSet()->children()

            ->scalarNode('route')
                ->info('Specifies the route to execute the query and display the search results.')
                ->defaultValue('app_search')
            ->end()

            ->enumNode('method')
                ->info('Specifies the request method to execute the query')
                ->values(RequestMethods::toArray())
                ->defaultValue(RequestMethods::GET->value)
            ->end()

            ->scalarNode('parameter')
                ->info('Specifies the query parameter to pass the search expression to the query')
                ->defaultValue("q")
            ->end()

        ->end()->end()

        ->arrayNode('results')
            ->info('Search results configuration settings.')
            ->addDefaultsIfNotSet()->children()

            ->scalarNode('template')
                ->info('Specifies the path to the template file used to display the results.')
                ->defaultValue("@Search/results/base.html")
            ->end()
    
            ->arrayNode('pagination')
                ->info('Results pagination configuration settings.')
                ->addDefaultsIfNotSet()->children()

                ->scalarNode('parameter')
                    ->info('Specifies the parameter of the current page.')
                    ->defaultValue("page")
                ->end()

                ->integerNode('per_page')
                    ->info('Specifies the number of item shown per page.')
                    ->defaultValue(10)
                ->end()
    
            ->end()->end()

            ->scalarNode('highlight')
                ->info('Specifies the name of the CSS class used to highlight the searched expression in the results page.')
                ->defaultNull()
            ->end()

        ->end()->end()

        ->arrayNode('entities')
            // TODO: Add "stat" boolean param, if true save the search result in database
            ->info('Configuration parameters for entities to be included in the search query.')
            ->arrayPrototype()
            ->info('Specifies the namespace of the entity to be included in the search query (App\Entity\Pizza).')
            ->children()

            ->scalarNode('alias')
                ->info('Specifies an entity alias to read and manipulate the results table more easily.')
                ->defaultNull()
            ->end()

            // ->arrayNode('serialize')
            //     ->info('Specifies names for API serialization.')
            //     ->scalarPrototype()->end()
            // ->end()

            ->scalarNode('template')
                ->info('Specifies the path to the template file used to display an item of this entity in the results page.')
                ->defaultValue("@Search/results/item.html")
            ->end()

            ->arrayNode('route')
                ->info('Entity route configuration settings.')
                ->addDefaultsIfNotSet()->children()

                ->scalarNode('name')
                    ->info('Specifies the name of the route to show the details of the entity.')
                    ->isRequired()
                ->end()

                ->arrayNode('parameters')
                    ->info('Specifies the names of the parameters from the previous route that should be generated.')    
                    ->defaultValue(['id'])
                    ->scalarPrototype()->end()
                ->end()
    
            ->end()->end()

            ->scalarNode('title')
                ->info('Specifies the name of the entity property that you want to use as the title in the results.')
                ->defaultValue("title")
            ->end()

            ->scalarNode('description')
                ->info('Specifies the name of the entity property that you want to use as the description in the results.')
                ->defaultValue("description")
            ->end()

            ->scalarNode('illustration')
                ->info('Specifies the name of the entity property that you want to use as the illustration in the results.')
                ->defaultFalse()
            ->end()

            ->arrayNode('criteria')
                ->info('Configuration parameters for query criteria.')
                ->arrayPrototype()
                ->info('Specify the name of the property that will be indexed by the search query.')
                ->children()

                ->enumNode('match')
                    ->info('Specify the operator that will be used to find a result.')
                    ->values(RequestOperators::toArray())
                    ->defaultValue(RequestOperators::LIKE->value)
                ->end()

                // TODO: Add force UPPER or Lower case searched expression

            ->end()->end()->end()

        ->end()->end()->end()

    ->end()->end();

    $definition->rootNode()->validate()->always(function ($providers) {

        foreach ($providers as $provider => $providerOptions)
        {
            foreach ($providerOptions['entities'] as $entity => $entityOptions)
            {
                if (empty($entity['alias']))
                {
                    $entityName = explode("\\", $entity);
                    $entityName = end($entityName);
                    $entityName = strtolower($entityName);

                    $providers[$provider]['entities'][$entity]['alias'] = $entityName;
                }
            }
        }

        return $providers;

    })->end();
};