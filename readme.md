# Symfony Search

Add search to your app pages.

1. [Quick install (no-comment)](./docs/install.no-comment.md)
2. [The configuration](./docs/config.md)
- [The search form](./docs/form.md)
- x [The results](./docs/results.md)
    - x [The controller](./docs/controller.md)
    - x [The items](./docs/item.md)
    - x [The pagination](./docs/pagination.md)
- x [The Twig functions and components](./docs/twig.md)
- x [The services](./docs/services.md)

## How to install

### Step 1: Download the Bundle

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```console
composer require osw3/symfony-search
```

### Step 2: Enable the Bundle

Then, enable the bundle by adding it to the list of registered bundles
in the `config/bundles.php` file of your project:

```php 
// config/bundles.php

return [
    // ...
    OSW3\Search\SearchBundle::class => ['all' => true],
];
```

#### (optional) Prepare composer for next updates

Edit the line `"osw3/symfony-search"` on your `composer.json`

```json 
{
    "require": {
        "osw3/symfony-search": "*",
    },
}
```

### Step 3: Expose the Bundle to Twig components

```yaml
twig_component:
    defaults:
        #...
        OSW3\Search\Components\: '@Search/'
```

## How to configure

- Config [sample](./docs/config.md#config-sample) and [properties](./docs/config.md#config-properties)

Add a minimum configuration to the `config/packages/search.yaml`.

```yaml 
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

## How to use

### Step 1 - Add the search router to your project

Link the router of the bundle to your `config/routes.yaml` file.

```yaml
_search:
    resource: '@SearchBundle/Controller/'
    type:     attribute
    prefix:   /search
```

### Step 2 - Add the twig component in your template.

```twig
<twig:Search />
```

[Read more about this twig component and options](./docs/form.md)