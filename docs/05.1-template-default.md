# Results page

## Customized your iwn results template

### Step 1 - Specifies the template location

Add this config in the `config/packages/search.yaml` file.

```yaml
search:
    full_provider:
        results:
            template: 'search/results.html.twig'
```

!!! IMPORTANT: if the `search/results.html.twig` file does not exist, the bundle will automatically create a copy of the Bundle results page template.

### Step 2 - Create your own template

Create and/or modify your `search/results.html.twig` file.

```twig
{% extends "base.html.twig" %}

{% block body %}
{% for item in search_results() %}
{{ search_set_item( item ) }}
<article>
    <a href="{{ search_item_url() }}">{{ search_item_title() }}</a>
    <p>{{ search_item_description() }}</p>
</article>
{% endfor %}
{% endblock body %}
```

Alternative

```twig
{% extends "base.html.twig" %}

{% block body %}
{% for item in results %}
<article>
    <a href="{{ url('app_book_show', {id: item.id}) }}">{{ item.title }}</a>
    <p>{{ item.description }}</p>
</article>
{% endfor %}
{% endblock body %}
```