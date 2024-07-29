# Twig functions & components

<br>

## Providers

### earch_provid

search_providers

`search_providers(string provider): void`

Return an array with providers names

```twig 
{{ search_providers('second_provider') }}
```

<br>

### search_current_provider

`search_current_provider()`

Return the name of the current provider

<br>

### search_use_provider

`search_use_provider()`

Set a provider

<br>

### search_provider_options

`search_provider_options()`

Return the array of options of the current provider

<br>

## Entities

### search_entities

`search_entities()`

Return the array of entities specified at `search.custom_provider.entities`

<br>

## Request

### search_request_method

`search_request_method()`

Return the method of the request specified at `search.custom_provider.
request.method©

<br>

### search_request_parameter

`search_request_parameter()`

Return the parameter name of the request specified at `search.
custom_provider.request.parameter

<br>

### search_request_expression

`search_request_expression()`

Return the searched expression

<br>

## Form

### search_form

`search_form()`

Render the search form

<br>

### search_form_template

`search_form_template()`

Return the path of the template of the search form

<br>

## Results

### search_results

`search_results()`

Return the array of the search query results

<br>

### search_results_url

`search_results_url()`

Return the absolute URL of the search results page

<br>

### search_results_path

`search_results_path()`

Return the relative path of the search results page

<br>

### search_results_total

`search_results_total()`

Return the total of item found

<br>

### search_results_route

`search_results_route()`

Return the name of the route of the results page

<br>

### search_results_template

`search_results_template()`

Return the path of the template of the results pages

<br>

## Items

<br>

### search_set_item

`search_set_item()`

Set item / entity has entity reference

<br>

### search_item_url

`search_item_url()`

Return the absolute URL of the item

<br>

### search_item_path

`search_item_path()`

Return the relative path of the item

<br>

### search_item_class

`search_item_class()`

Return the entity classname

<br>

### search_item_alias

`search_item_alias()`

Return the entity alias

<br>

### search_item_title

`search_item_title()`

Return the title of the entity

<br>

### search_item_description

`search_item_description()`

Return the description of the entity

<br>

### search_item_illustration

`search_item_illustration()`

Return the illustration of the entity

<br>

### search_item_template

`search_item_template()`

Return the template path of the item

<br>

## Pagination

### search_pagination

`search_pagination()`

<br>

### search_pagination_page

`search_pagination_page()`

<br>

### search_pagination_pages

`search_pagination_pages()`

<br>

### search_pagination_links

`search_pagination_links()`

<br>

### search_pagination_first_link

`search_pagination_first_link()`

<br>

### search_pagination_last_link

`search_pagination_last_link()`

<br>

### search_pagination_prev_link

`search_pagination_prev_link()`

<br>

### search_pagination_next_link

`search_pagination_next_link()`

<br>

### search_pagination_per_page

`search_pagination_per_page()`

<br>

## Misc

<br>

### highlight

`highlight(): string`

Return the string with marker tag

<br>

### highlight_stat

`highlight_stat(): int`
