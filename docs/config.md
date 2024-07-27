# Configuration

## How to debug your config

```shell
bin/console config:dump-reference SearchBundle
```

```shell
bin/console debug:config SearchBundle
```

## Config Sample

### Minimalist configuration example

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
                title: name
                criteria:
                    name:
                        match: like
                    description:
                        match: like
```

In this config, we have one provider named `first_provider`. You can customize the provider name to identify the sections of your application on which the search bundle runs.

Next, we define the entities on which the search query applies.
Here, the search query applies to `App\Entity\Book` and `App\Entity\Product`.

### Full configuration example

```yaml
search:
    first_provider:

        form:
            template: '@Search/form.html.twig'
        
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
                serialize: ['book']
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
                alias: book 
                serialize: ['product']
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

## Config properties

### `provider`
`array` - `required`  
Provide a configuration settings.
    
A provider is simply a custom name to identify the configuration settings that follow it.

    - `form` *array* - *optional*
        Search form configuration settings.

        - `template` *string* - *optional*
            *Default value*: `@Search/form/base.html`

            Specifies the path to the template file used to display the search form.
            
            You can create your own [customized form template](./form.md#customize-your-search-form).

    - `request` *array* - *optional*
        Search request configuration settings.

        - `route` *string* - *optional*
            *Default value*: `search`

            Specifies the route to execute the query and display the search results.
            
            Yan can create your own [customized route and controller](./controller.md#create-your-own-customized-route-and-controller).

        - `method` *enum* - *optional*
            *Default value*: `GET`
            *Accepted values*: `GET`,`POST`

            Specifies the request method to execute the query.

        - `parameter` *string* - *optional*
            *Default value*: `q`

            Specifies the query parameter to pass the search expression to the query.
            
            Example if the user search "lorem", the request URL wil be `/search?q=lorem`.

    - `results` *array* - *optional*
        Search results configuration settings.

        - `template` *string* - *optional*
            *Default value*: `@SeSearch/results/item.html.twig`

            Specifies the path to the template file used to display the results.
            
            You can create your own [customized results template](./results.md#create-your-own-customized-results-template).
            
        - `pagination` *array* - *optional*
            Results pagination configuration settings.

            - `parameter` *string* - *optional*
                *Default value*: `page`

                Specifies the parameter of the current page.

                Example: `/search?q=lorem&page=2`.
            
            - `per_page` *integer* - *optional*
                *Default value*: `10`

                Specifies the number of item shown per page.

        - `highlight` *string* - *optional*
            *Default value*: `null`

            Specifies the name of the CSS class used to highlight the searched expression in the results page.

            See [Highlight](./highlight.md)

    - `entities` *array* - *required*
        Configuration parameters for entities to be included in the search query.

        - `Entity\Namespace` *array* - *required*
            Specifies the namespace of the entity to be included in the search query.

            - `alias` *string* - *optional*
                *Default value*: `null`

                Specifies an entity alias to read and manipulate the results table more easily.

                If null, the alias will be automatically generated.

                Example if the Entity is `App\Entity\Book`, the alias will be `book`

            - `serialize` *array* - *optional*
                *Default value*: `[]`

            - `template` *string* - *optional*
                *Default value*: `@Search/results/item.html`

                Specifies the path to the template file used to display an item of this entity in the results page.
                
                You can create your own [customized results template](./item.md#create-your-own-customized-template).
                
            - `route` *array* - *required*
                Entity route configuration settings.

                - `name` *string* - *required*
                    Specifies the name of the route to show the details of the entity.

                - `parameters` *array* - *optional*
                    *Default value*: `['id']`

                    Specifies the names of the parameters from the previous route that should be generated.

            - `title` *null|string|false* - *optional*
                *Default value*: `null`

                Specifies the name of the entity property that you want to use as the title in the results.

                If `null`, the bundle get the property named `title` of the entity like `$entity->getTitle()`.

                if false, the bundle ignores retrieving the property value.

            - `description` *null|string|false* - *optional*
                *Default value*: `null`

                Specifies the name of the entity property that you want to use as the description in the results.

                If `null`, the bundle get the property named `description` of the entity like `$entity->getDescription()`.

                if false, the bundle ignores retrieving the property value.

            - `illustration` *null|string|false* - *optional*
                *Default value*: `false`

                Specifies the name of the entity property that you want to use as the illustration in the results.

                If `null`, the bundle get the property named `illustration` of the entity like `$entity->getIllustration()`.

                if false, the bundle ignores retrieving the property value.

            - `criteria` *array* - *required*
                Configuration parameters for query criteria.
                
                - `property` *array* - *required*
                    Specify the name of the property that will be indexed by the search query.

                    Example: `title`
                    
                    - `match` *enum* - *optional*
                        *Accepted values*: `equal`, `is-not`, `like`, `left-like`, `right-like`, `not-like`, `not-left-like`, `not-right-like`, `post`
                        *Default value*: `like`

                        Specify the operator that will be used to find a result.

