# Install (process explained)

## Step 1 - Download with composer

### Step 1.a - Download the Bundle

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```console
composer require osw3/symfony-search
```

<br>

### Step 1.b - Edit the line `"osw3/symfony-search"` of `composer.json` (optional)

Edit the line `"osw3/symfony-search"` on your `composer.json`

```json 
{
    "require": {
        "osw3/symfony-search": "*",
    },
}
```

<br>

## Step 2 - Enable the Bundle

Then, enable the bundle by adding it to the list of registered bundles
in the `config/bundles.php` file of your project:

```php 
// config/bundles.php

return [
    // ...
    OSW3\Search\SearchBundle::class => ['all' => true],
];
```

<br>

## Step 3 - Expose the Bundle to Twig components

```yaml
twig_component:
    defaults:
        #...
        OSW3\Search\Components\: '@Search/'
```

<br>

## Step 4 - Enable the bundle router

Link the router of the bundle to your `config/routes.yaml` file.

```yaml
_search:
    resource: '@SearchBundle/Controller/'
    type:     attribute
    prefix:   /search
```

<br>

## Step 5 - Add a quick config

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

<br>

## Step 6 - Add the Search Component to your template

```twig
<twig:Search />
```