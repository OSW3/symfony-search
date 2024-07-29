# Install (no-comment process)

Step by step. No comment.

<br>

## Step 1 - Download with composer

### Step 1.a - Download the Bundle

```shell 
composer require osw3/symfony-search
```

<br>

### Step 1.b - Edit the line `"osw3/symfony-search"` of `composer.json` (optional)

```json 
{
    "require": {
        "osw3/symfony-search": "*",
    },
}
```

<br>

## Step 2 - Enable the Bundle

```php
// config/bundles.php

return [
    // ...
    OSW3\Search\SearchBundle::class => ['all' => true],
];
```

<br>

## Step 3 - Expose the Bundle to Twig components

```twig
# config/packages/twig_component.yaml

twig_component:
    defaults:
        #...
        OSW3\Search\Components\: '@Search/'
```

<br>

## Step 4 - Enable the bundle router

```yaml
# config/routes.yaml

_search:
    resource: '@SearchBundle/Controller/'
    type:     attribute
    prefix:   /search
```

<br>

## Step 5 - Add a quick config

```yaml 
# config/packages/search.yaml

search:
    main:
        entities: 
            App\Entity\Book:
                route: 
                    name: app_book_show
                criteria:
                    title:
                        match: like
```

<br>

## Step 6 - Add the Search Component to your template

```twig
<twig:Search />
```