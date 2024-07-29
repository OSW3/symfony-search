# Customize the Search route 

<br>

## Method 1 - Customize the URL but keep using the default controller

Enable the bundle router by adding the route reference to your `config/routes.yaml` file and changing the value of the `prefix` line.

```yaml
_search:
    resource: '@SearchBundle/Controller/'
    type:     attribute
    #prefix:   /search
    prefix:   /my-custom-search
```

the name of the route remains unchanged, but the url will be modified.

<br> 

## Method 2 - Create your own controller and customize the route name

See : [Customize the Search controller](./controller.md)
