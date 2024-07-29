# Configuration properties

<br>

## provider

Provide a configuration settings.  
A provider is simply a custom name to identify the configuration settings that follow it.

- Path: `search.<provider>`
- Type: `array`
- `required`

```yaml
search:
    first_provider: [ ... ]
    second_provider: [ ... ]
```

<br>

## form

Search form configuration settings.

- Path: `search.<provider>.form`
- Type: `array`
- `optional`

```yaml
search:
    first_provider: 
        from: [ ... ]
```

<br>

## template 

Specifies the path to the template file used to display the search form. 
You can create your own [customized form template](./form.md#customize-your-search-form).

- Path: `search.<provider>.form.template`
- Type: `string`
- Default: `@Search/form/base.html`
- `optional`

```yaml
search:
    first_provider: 
        from: 
            template: '@Search/form/base.html'
```

<br>

## request

Search request configuration settings.

- Path: `search.<provider>.request`
- Type: `array`
- `optional`

```yaml
search:
    first_provider: 
        request: [ ... ]
```

<br>

## route

Specifies the route to execute the query and display the search results. 
Yan can create your own [customized route and controller](./controller.md#create-your-own-customized-route-and-controller).

- Path: `search.<provider>.request.route`
- Type: `array`
- Default: `search`
- `optional`

```yaml
search:
    first_provider: 
        request: 
            route: search
```

<br>

## method

Specifies the request method to execute the query.

- Path: `search.<provider>.request.method`
- Type: `enum`
- Accepted: `GET`,`POST`
- Default: `GET`
- `optional`

```yaml
search:
    first_provider: 
        request: 
            method: GET
```

<br>

## parameter

Specifies the query parameter to pass the search expression to the query. 
Example if the user search "lorem", the request URL wil be `/search?q=lorem`.

- Path: `search.<provider>.request.parameter`
- Type: `string`
- Default: `q`
- `optional`

```yaml
search:
    first_provider: 
        request: 
            parameter: q
```

<br>

## results

- Path: `search.<provider>.results`
- Type: `array`
- `optional`

```yaml
search:
    first_provider: 
        results: [ ... ]
```

<br>

## template

Specifies the path to the template file used to display the results.  
You can create your own [customized results template](./results.md#create-your-own-customized-results-template).

- Path: `search.<provider>.results.template`
- Type: `string`
- Default: `@SeSearch/results/item.html.twig`
- `optional`

```yaml
search:
    first_provider: 
        results: 
            template: '@SeSearch/results/item.html.twig'
```

<br>

## pagination

Results pagination configuration settings.

- Type: `array`
- Path: `search.<provider>.results.pagination`
- `optional`

```yaml
search:
    first_provider: 
        results: 
            pagination: [ ... ]
```

<br>

## parameter

Specifies the parameter of the current page.

- Path: `search.<provider>.results.pagination.parameter`
- Type: `string`
- Default: `page`
- `optional`

Example: `/search?q=lorem&page=2`.

```yaml
search:
    first_provider: 
        results: 
            pagination: 
                parameter: page
```

<br>

## per_page

Specifies the number of item shown per page.

- Path: `search.<provider>.results.pagination.per_page`
- Type: `integer`
- Default: `10`
- `optional`

```yaml
search:
    first_provider: 
        results: 
            pagination: 
                parameter: page
```

<br>

## highlight

Specifies the name of the CSS class used to highlight the searched expression in the results page.

See [Highlight](./highlight.md)

- Path: `search.<provider>.results.highlight`
- Type: `string`
- Default: `null`
- `optional`

```yaml
search:
    first_provider: 
        results: 
            pagination: 
                highlight: highlight
```

<br>

## entities

Configuration parameters for entities to be included in the search query.

- Path: `search.<provider>.entities`
- Type: `array`
- `required`

```yaml
search:
    first_provider: 
        entities: [ ... ]
```

<br>

## entity

Specifies the namespace of the entity to be included in the search query.

- Path: `search.<provider>.entities.<entity>`
- Type: `array`
- `required`

```yaml
search:
    first_provider: 
        entities: 
            App\Entity\Book: [ ... ]
```

<br>

## alias

Specifies an entity alias to read and manipulate the results table more easily.

If null, the alias will be automatically generated.

Example if the Entity is `App\Entity\Book`, the alias will be `book`

- Path: `search.<provider>.entities.<entity>.alias`
- Type: `string`
- Default: `null`
- `optional`

```yaml
search:
    first_provider: 
        entities: 
            App\Entity\Book:
                alias: book
```

<br>

## serialize

- Path: `search.<provider>.entities.<entity>.serialize`
- Type: `array`
- Default: `[]`
- `optional`

```yaml
search:
    first_provider: 
        entities: 
            App\Entity\Book:
                serialize: [ ... ]
```

<br>

## template

Specifies the path to the template file used to display an item of this entity in the results page.

You can create your own [customized results template](./item.md#create-your-own-customized-template).

- Path: `search.<provider>.entities.<entity>.
template`
- Type: `string`
- Default: `@Search/results/item.html`
- `optional`

```yaml
search:
    first_provider: 
        entities: 
            App\Entity\Book:
                template: '@Search/results/item.html'
```

<br>

## route

Entity route configuration settings.

- Path: `search.<provider>.entities.<entity>.route`
- Type: `array`
- `required`

```yaml
search:
    first_provider: 
        entities: 
            App\Entity\Book:
                route: [ ... ]
```

<br>

## name

Specifies the name of the route to show the details of the entity.

- Path: `search.<provider>.entities.<entity>.route.name`
- Type: `string`
- `required`

```yaml
search:
    first_provider: 
        entities: 
            App\Entity\Book:
                route: 
                    name: app_book_show
```

<br>

## parameters

Specifies the names of the parameters from the previous route that should be generated.

- Path: `search.<provider>.entities.<entity>.route.parameters`
- Type: `array`
- Default: `['id']`
- `optional`

```yaml
search:
    first_provider: 
        entities: 
            App\Entity\Book:
                route: 
                    parameters: ['id']
```

<br>

## title

Specifies the name of the entity property that you want to use as the title in the results.

If `null`, the bundle get the property named `title` of the entity like `$entity->getTitle()`.

if false, the bundle ignores retrieving the property value.

- Path: `search.<provider>.entities.<entity>.title`
- Type: `null|string|false`
- Default: `null`
- `optional`

```yaml
search:
    first_provider: 
        entities: 
            App\Entity\Book:
                title: title
```

<br>

## description

Specifies the name of the entity property that you want to use as the description in the results.

If `null`, the bundle get the property named `description` of the entity like `$entity->getDescription()`.

if false, the bundle ignores retrieving the property value.

- Path: `search.<provider>.entities.<entity>.description`
- Type: `null|string|false`
- Default: `null`
- `optional`

```yaml
search:
    first_provider: 
        entities: 
            App\Entity\Book:
                description: description
```

<br>

## illustration

Specifies the name of the entity property that you want to use as the illustration in the results.

If `null`, the bundle get the property named `illustration` of the entity like `$entity->getIllustration()`.

if false, the bundle ignores retrieving the property value.

- Path: `search.<provider>.entities.<entity>.illustration`
- Type: `null|string|false`
- Default: `false`
- `optional`

```yaml
search:
    first_provider: 
        entities: 
            App\Entity\Book:
                illustration: false
```

<br>

## criteria

Configuration parameters for query criteria.

- Path: `search.<provider>.entities.<entity>.criteria`
- Type: `array`
- `required`

```yaml
search:
    first_provider: 
        entities: 
            App\Entity\Book:
                criteria: [ ... ]
```

<br>

## property

Specify the name of the property that will be indexed by the search query.
Example: `title`

- Path: `search.<provider>.entities.<entity>.criteria.<property>`
- Type: `array`
- `required`

```yaml
search:
    first_provider: 
        entities: 
            App\Entity\Book:
                criteria: 
                    title: [ ... ]
```

<br>

## match

Specify the operator that will be used to find a result.

- Path: `search.<provider>.entities.<entity>.criteria.<property>.match`
- Type: `enum`
- Accepted: `equal`, `is-not`, `like`, `left-like`, `right-like`, `not-like`, `not-left-like`, `not-right-like`, `post`
- Default: `like`
- `optional`

```yaml
search:
    first_provider: 
        entities: 
            App\Entity\Book:
                criteria: 
                    title: 
                        match: like
```