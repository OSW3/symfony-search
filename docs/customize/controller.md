# Customize the Search controller 

<br>

## Step 1 - Create your custom controller

```shell
bin/console make:controller CustomSearchController
```

This command will create a new controller `src/Controller/CustomSearchController.php`

```php
<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CustomSearchController extends AbstractController
{
    #[Route('/custom/search', name: 'app_custom_search')]
    public function index(): Response
    {
        return $this->render('custom_search/index.html.twig', [
            'controller_name' => 'CustomSearchController',
        ]);
    }
}
```

> NOTE: The route name is `app_custom_search`

<br>

## Step 2 - Customize the route

### Step 2.1 - Customize the route name and path

Edit this line to custimize.

```php
#[Route('/custom/search', name: 'app_custom_search')]
```

<br>

### Step 2.2 - Set the route

Set your new route has the search request route in the `config/packages/search.yaml`.

```yaml
search:
    main:
        request:
            route: app_custom_search
```

<br>

## Step 3 - Fetch the query results

```php
use OSW3\Search\Service\QueryService;

class CustomSearchController extends AbstractController
{
    public function __construct(
        private QueryService $searchQueryService
    ){}

    // ...
    public function index(): Response
    {
        // ...

        // Retrieve search query results
        $results = $this->searchQueryService->fetch();

        return $this->render('custom_search/index.html.twig', [
            'results' => $results,
        ]);
    }
}
```

## Step 4 - Display the results

You ca use the default results page of the bundle or you can create your own customized results page.

### Step 4.1 - Use the default results page

```php 
use OSW3\Search\Service\ResultsService;

public function __construct(
    // ...
    private ResultsService $resultsService
){}

// ...

public function index(): Response
{
    // ...

    $template = $this->resultsService->getTemplate();
    
    return $this->render($template, [
        'results' => $results,
    ]);
}
```

<br>

### Step 4.2 - Create your own customized results page

Ignore the Step 4.1 ans see how to [customize the results page template](./template.md)