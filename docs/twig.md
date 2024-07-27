# Twig functions & components

## Providers

- `search_providers()`
    Return an array with providers names

- `search_current_provider()`
    Return the name of the current provider

- `search_use_provider()`
    Set a provider

- `search_provider_options()`
    Return the array of options of the current provider

## Entities

- `search_entities()`
    Return the array of entities specified at `search.custom_provider.entities`

## Request

- `search_request_method()`
    Return the method of the request specified at `search.custom_provider.request.method©

- `search_request_parameter()`
    Return the parameter name of the request specified at `search.custom_provider.request.parameter

- `search_request_expression()`
    Return the searched expression

## Form

- `search_form()`
    Render the search form

- `search_form_template()`
    Return the path of the template of the search form

## Results

- `search_results()`
    Return the array of the search query results

- `search_results_url()`
    Return the absolute URL of the search results page

- `search_results_path()`
    Return the relative path of the search results page

- `search_results_total()`
    Return the total of item found

- `search_results_route()`
    Return the name of the route of the results page

- `search_results_template()`
    Return the path of the template of the results pages

## Items

- `search_item_entity()`

- `search_item_url()`

- `search_item_path()`

- `search_item_class()`

- `search_item_alias()`

- `search_item_title()`

- `search_item_description()`

- `search_item_illustration()`

- `search_item_template()`

## Pagination

- `search_pagination()`

- `search_pagination_page()`

- `search_pagination_pages()`

- `search_pagination_links()`

- `search_pagination_first_link()`

- `search_pagination_last_link()`

- `search_pagination_prev_link()`

- `search_pagination_next_link()`

- `search_pagination_per_page()`

## Misc

- `highlight()`

- `highlight_stat()`