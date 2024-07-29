# Minimalist Configuration example

<br>

## How to debug your config

> The following command allows you to see the structure of the bundle configuration.

```shell
bin/console config:dump-reference SearchBundle
```

> The following command allows you to see the status of your configuration.

```shell
bin/console debug:config SearchBundle
```

<br>

## Minimalist configuration example

```yaml
search:
    first_provider:
        entities: 
            App\Entity\Book:
                route: app_book_show
                criteria:
                    title:
                        match: like
            App\Entity\Product:
                route: app_product_show
                criteria:
                    name:
                        match: like
```

In this config, we have one provider named `first_provider`. You can customize the provider name to identify the sections of your application on which the search bundle runs.

Next, we define the entities on which the search query applies.
Here, the search query applies to `App\Entity\Book` and `App\Entity\Product`.
