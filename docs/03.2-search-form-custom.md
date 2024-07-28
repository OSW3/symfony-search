# Customize the Search form 

## Step 1 - Create the template file

Create your twig template in the `templates` directory of your project.

e.g.: `templates/search/form.html.twig`

## Step 2 - Specifies the template location

Add this config iIn the `config/packages/search.yaml` file.

```yaml
search:
    full_provider:
        form:
            template: 'search/form.html.twig'
```

## Step 3 - Create your form

### Method 1

```html
<form id="{{ id }}" class="{{ class }}" action="{{ search_results_url() }}" method="{{ search_request_method() }}">
    <input type="search" name="{{ search_request_parameter() }}" placeholder="{{ placeholder|default('Search for something') }}" value="{{ search_request_expression() }}" aria-label="{{ label }}">
    <button type="submit">{{ label|default('search') }}</button>
</form>
```

### Method 2

```html
<form id="{{ id }}" class="{{ class }}" action="{{ search_results_url() }}" method="{{ search_request_method() }}">
    <twig:Search:Input />
    <twig:Search:Submit :label="label" />
</form>
```
