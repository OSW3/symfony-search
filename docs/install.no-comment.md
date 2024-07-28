# Install the bundle 

Step by step install, no comment.

## Step 1.a - Download the Bundle

```shell 
composer require osw3/symfony-search
```

## Step 1.b - Edit the line `"osw3/symfony-search"` (optional)

```json 
// Composer.json

{
    "require": {
        "osw3/symfony-search": "*",
    },
}
```

## Step 2 - Enable the Bundle

```php
// config/bundles.php

return [
    // ...
    OSW3\Search\SearchBundle::class => ['all' => true],
];
```

## Step 3 - Expose the Bundle to Twig components

```twig
# config/packages/twig_component.yaml

twig_component:
    defaults:
        #...
        OSW3\Search\Components\: '@Search/'
```

## Step 4 - Enable the bundle router

```yaml
# config/routes.yaml

_search:
    resource: '@SearchBundle/Controller/'
    type:     attribute
    prefix:   /search
```

## Step 5 - Add a quick config

```yaml 
# config/packages/search.yaml

search:

    main:
        entities: 
            App\Entity\Book: # Define the entities on which the search is applied
                route: 
                    name: app_book_show # Set the route to display the details of an entity
                criteria:
                    title: # Define the properties on which the search is applied
                        match: like # Define how the search is applied on the property
```

## Step xxx - Add the Search Component to your template

```twig
<twig:Search />
```
