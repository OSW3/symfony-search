# Symfony Search

Add search to your app pages.

1. [Quick install](./docs/01-quick-install.md) (no-comment)
2. Configuration
    - [A minimalist example](./docs/02.1-minimalist-configuration.md)
    - [A full example](./docs/02.2-full-cofiguration.md)
    - [Properties reference](./docs/02.3-configuration-properties.md)
3. Search form
    - [Use default search form](./docs/03.1-search-form-default.md)
    - [Customize search form](./docs/03.2-search-form-custom.md)
4. Fetch the query results
    - [Use the default route and controller](./docs/04.1-route-controller-default.md)
    - [Customize route and/or controller](./docs//04.2-route-controller-custom.md)
5. Show results in Twig template
    - [Use the bundle's Twig template](./docs/05.1-template-default.md)
    - [Customize your Twig template](./docs/05.2-template-custom.md)


## Install & Config

### Step 1 - Install the Bundle

#### Step 1.1. - Download with composer

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```console
composer require osw3/symfony-search
```

#### Step 1.2. - (optional) Prepare composer for next updates

Edit the line `"osw3/symfony-search"` on your `composer.json`

```json 
{
    "require": {
        "osw3/symfony-search": "*",
    },
}
```

### Step 2 - Enable the Bundle

Then, enable the bundle by adding it to the list of registered bundles
in the `config/bundles.php` file of your project:

```php 
// config/bundles.php

return [
    // ...
    OSW3\Search\SearchBundle::class => ['all' => true],
];
```

### Step 3 - Expose the Bundle to Twig components

```yaml
twig_component:
    defaults:
        #...
        OSW3\Search\Components\: '@Search/'
```

### Step 4 - Configure

- Config [sample](./docs/config.md#config-sample) and [properties](./docs/config.md#config-properties)

Add a minimum configuration to the `config/packages/search.yaml`.

```yaml 
search:
    main:
        entities: 
            # Define the entities on which the search is applied
            App\Entity\Book: 
                route: 
                    # Set the route to display the details of an entity
                    name: app_book_show 
                criteria:
                    # Define the properties on which the search is applied
                    title: 
                        # Define how the search is applied on the property
                        match: like 
```

### Step 5 - Enable the search router

Link the router of the bundle to your `config/routes.yaml` file.

```yaml
_search:
    resource: '@SearchBundle/Controller/'
    type:     attribute
    prefix:   /search
```

### Step 6 - Add the twig component in your template.

```twig
<twig:Search />
```