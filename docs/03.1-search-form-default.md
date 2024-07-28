# Render the Search form 

## Method 1 - Render the search form by Twig component

```twig 
<twig:Search id="my-custom-id" class="my-custom-class" placeholder="Search for something" label="search" />
```

## Method 2 - Render the search form by Twig function

```twig 
{{ search_form([
    id: "my-custom-id",
    class: "my-custom-class",
    placeholder: "Search for something",
    label: "search"
]) }}
```

## Parameters

### id

Specifies your custom ID attribute.

- Type: `string`
- Default: `null`
- `optional`

### class

Secifies your custom CSS class attribute.

- Type: `string`
- Default: `null`
- `optional`

### placeholder

Specifies your custom Placeholder attribute.

- Type: `string`
- Default: `Search for something`
- `optional`

### label

Specifies your the text label of the submit button.

- Type: `string`
- Default: `search`
- `optional`