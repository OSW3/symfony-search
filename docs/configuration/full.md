# Full Configuration example

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


## Full configuration example

In this example, we assume that you have created entities `App\Entity\Book` and `App\Entity\Product`

```yaml
search:
    first_provider:
        form:
            template: '@Search/form.html'
        request:
            route: search
            method: GET
            parameter: q
        results:
            template: '@Search/results.html.twig'
            pagination:
                parameter: page
                per_page: 10
            highlight: highlight
        entities: 
            App\Entity\Book:
                alias: book 
                template: "@Search/results/item.html.twig"
                route: 
                    name: app_book_show
                    parameters: ['id']
                title: title
                description: description
                illustration: false
                criteria:
                    title:
                        match: like
                    description:
                        match: like
            App\Entity\Product:
                alias: product 
                template: "@Search/results/item.html"
                route: 
                    name: app_product_show
                    parameters: ['id']
                title: name
                description: description
                illustration: false
                criteria:
                    name:
                        match: like
                    description:
                        match: like
```