# Search form 

## Render the default form

### Method 1 - Render the search form by Twig component

```twig 
<twig:Search id="my-custom-id" class="my-custom-class" placeholder="Search for something" label="search" />
```

### Method 2 - Render the search form by Twig function

```twig 
{{ search_form([
    id: "my-custom-id",
    class: "my-custom-class",
    placeholder: "Search for something",
    label: "search"
]) }}
```

### Parameters

#### id

Specifies your custom ID attribute.

- Type: `string`
- Default: `null`
- `optional`

#### class

Specifies your custom CSS class attribute.

- Type: `string`
- Default: `null`
- `optional`

#### placeholder

Specifies your custom Placeholder attribute.

- Type: `string`
- Default: `Search for something`
- `optional`

#### label

Specifies your the text label of the submit button.

- Type: `string`
- Default: `search`
- `optional`

## Customized your Search form

### Step 1 - Create the template file

Create your twig template in the `templates` directory of your project.

e.g.: `templates/search/form.html.twig`

### Step 2 - Add the HTML content

```html
<form id="{{ id }}" class="{{ class }}" action="{{ search_results_url() }}" method="{{ search_request_method() }}">
    <input type="search" name="{{ search_request_parameter() }}" placeholder="{{ placeholder|default('Search for something') }}" value="{{ search_request_expression() }}" aria-label="{{ label }}">
    <button type="submit">{{ label|default('search') }}</button>
</form>
```

Alternative:

```html
<form id="{{ id }}" class="{{ class }}" action="{{ search_results_url() }}" method="{{ search_request_method() }}">
    <twig:Search:Input />
    <twig:Search:Submit :label="label" />
</form>
```

### Step 3 - Specifies the template location

Add this config iIn the `config/packages/search.yaml` file.

```yaml
search:
    full_provider:
        form:
            template: 'search/form.html.twig'
```
