# Services Methods

<br>

## EntityService

### Autowire the EntityService

```php
use OSW3\Search\Service\EntityService;

// ...

public function __construct(
    private EntityService $entityService
){}
```

<br>

### EntityService Methods

#### getAll()

`getAll(): array`

Returns the list of names of the entities on which the search applies.

```php
$this->entityService->getAll();
// [
//   0 => "App\Entity\Book"
//   1 => "App\Entity\Product"
// ]
```

<br>

#### exclude

Adding entities to the exclusion list

`exclude(string $entity): static`

```php
// Exclude some entities
$this->entityService->exclude("App\Entity\Product");

// The query will not apply to the entity App\Entity\Product
$results = $this->queryService->fetch();
```

Using exclusion in a conditional closure

```php
if ($exclude_products) {
    $this->entityService->exclude("App\Entity\Product");
}

$this->entityService->queryable();
// [
//   0 => "App\Entity\Book"
// ]
```

<br>

#### queryable

Return the list of queryable entities.
This is the list of entities on which the search query will apply

`queryable(): array`


```php
$this->entityService->queryable();
// [
//   0 => "App\Entity\Book"
//   1 => "App\Entity\Product"
// ]

$this->entityService->exclude("App\Entity\Product");
$this->entityService->queryable();
// [
//   0 => "App\Entity\Book"
// ]
```

<br>

#### getOptions

Returns the configuration of a specific entity

`getOptions(string $entity): array`

```php 
$this->entityService->getOptions("App\Entity\Book") ); 
// [
//   "route" => [ ... ]
//   "criteria" =>  [ ... ]
//   "alias" => "book"
//   "template" => "@Search/results/item.html"
//   "title" => "title"
//   "description" => "description"
//   "illustration" => false
// ]
```

<br>
<br>

## FormService

### Autowire the FormService

```php
use OSW3\Search\Service\FormService;

// ...

public function __construct(
    private FormService $formService
){}
```

<br>

### FormService Methods

#### getTemplate

Returns the path of the form template.

`getTemplate(): string`

```php 
$this->formService->getTemplate();
// "@Search/form/base.html"
```

<br>
<br>

## ItemService

### Autowire the ItemService

```php
use OSW3\Search\Service\ItemService;

// ...

public function __construct(
    private ItemService $itemService
){}
```

<br>

### ItemService Methods

#### setEntity

Initialize the context of the entity being iterated

`setEntity(): static`

```php 
$results = $this->queryService->fetch();
foreach ($results as $item) {
    $this->itemService->setEntity($item);
    // ...
}
```

<br>

#### getClass

Returns the name of the entity class of the current context

`getClass(): string`

```php 
$results = $this->queryService->fetch();
foreach ($results as $item) {
    $this->itemService->setEntity($item);
    
    $this->itemService->getClass();
    // App\Entity\Book
}
```

<br>

#### getAlias

Returns the alias of the current entity

`getAlias(): string`

```php 
$results = $this->queryService->fetch();
foreach ($results as $item) {
    $this->itemService->setEntity($item);
    
    $this->itemService->getAlias();
    // book
}
```

<br>

#### getTemplate

Returns the template path of the current entity

`getTemplate(): string`

```php 
$results = $this->queryService->fetch();
foreach ($results as $item) {
    $this->itemService->setEntity($item);
    
    $this->itemService->getTemplate();
    // @Search/results/item.html
}
```

<br>

#### getRoute

Returns the name of the route of the current entity.

`getRoute(): string`

```php 
$results = $this->queryService->fetch();
foreach ($results as $item) {
    $this->itemService->setEntity($item);
    
    $this->itemService->getRoute();
    // app_book_show
}
```

<br>

#### getRouteParams

Returns the list of parameter names needed to generate the url

`getRouteParams(): array`

```php 
$results = $this->queryService->fetch();
foreach ($results as $item) {
    $this->itemService->setEntity($item);
    
    $this->itemService->getRouteParams();
    // [
    //   0 => "id"
    // ]
}
```

<br>

#### getUrl

Returns the absolute or relative url of the current entity.

`getUrl(bool $absolute=true): string`

```php 
$results = $this->queryService->fetch();
foreach ($results as $item) {
    $this->itemService->setEntity($item);
    
    $this->itemService->getUrl();
    // site.com/book/42
    
    $this->itemService->getUrl(false);
    // /book/42
}
```

<br>

#### getPath

Returns the relative path of the current entity.

Alias of `getUrl(false)`

`getPath(): string`

```php 
$results = $this->queryService->fetch();
foreach ($results as $item) {
    $this->itemService->setEntity($item);
    
    $this->itemService->getPath(false);
    // /book/42
}
```

<br>

#### getTitle

Returns the "title" of the current entity

`getTitle(): ?string`

```php 
$results = $this->queryService->fetch();
foreach ($results as $item) {
    $this->itemService->setEntity($item);
    
    $this->itemService->getTitle();
}
```

<br>

#### getDescription

Returns the "description" of the current entity

`getDescription(): ?string`

```php 
$results = $this->queryService->fetch();
foreach ($results as $item) {
    $this->itemService->setEntity($item);
    
    $this->itemService->getDescription();
}
```

<br>

#### getIllustration

Returns the "illustration" of the current entity

`getIllustration(): ?string`

```php 
$results = $this->queryService->fetch();
foreach ($results as $item) {
    $this->itemService->setEntity($item);
    
    $this->itemService->getIllustration();
}
```

<br>
<br>

## PaginationService

### Autowire the PaginationService

```php
use OSW3\Search\Service\PaginationService;

// ...

public function __construct(
    private PaginationService $paginationService
){}
```

<br>

### PaginationService Methods

#### getPage

Returns the current page number

`getPage(): int`

```php 
$this->paginationService->getPage();
// 4
```

<br>

#### getPages

Returns the number of total pages

`getPages(): int`

```php 
$this->paginationService->getPages();
// 6
```

<br>

#### getLinks

Returns pagination links

`getLinks((?string $id=null): null|string|array`

`$id`value can be `first`, `prev`, `next`, `last`

```php 
$this->paginationService->getLinks();
// [
//   0 => [
//     "current" => false
//     "url" => "http://site.com/search/?q=lor&page=1"
//   ],
//   1 => [
//     "current" => false
//     "url" => "http://site.com/search/?q=lor&page=2"
//   ],
//   2 => [
//     "current" => false
//     "url" => "http://site.com/search/?q=lor&page=3"
//   ],
//   3 => [
//     "current" => true
//     "url" => "http://site.com/search/?q=lor&page=4"
//   ],
//   4 => [
//     "current" => false
//     "url" => "http://site.com/search/?q=lor&page=5"
//   ],
//   5 => [
//     "current" => false
//     "url" => "http://site.com/search/?q=lor&page=6"
//   ],
// ]
```

```php 
$this->paginationService->getLinks('first');
// "http://site.com/search/?q=lor&page=1"
```

<br>

#### getFirstLink

Returns the URL of the first page

`getFirstLink(): string`

```php 
$this->paginationService->getFirstLink();
// "http://site.com/search/?q=lor&page=1"
```

<br>

#### getLastLink

Returns the URL of the last page

`getLastLink(): string`

```php 
$this->paginationService->getLastLink();
// "http://site.com/search/?q=lor&page=6"
```

<br>

#### getPrevLink

Returns the URL of the previous page

`getPrevLink(): string`

```php 
$this->paginationService->getPrevLink();
// "http://site.com/search/?q=lor&page=3"
```

<br>

#### getNextLink

Returns the URL of the next page

`getNextLink(): string`

```php 
$this->paginationService->getNextLink();
// "http://site.com/search/?q=lor&page=5"
```

<br>

#### getPerPage

Returns the number max of items PerPage

`getPerPage(): int`

```php 
$this->paginationService->getPerPage();
// 10
```

<br>


## ProviderService

### Autowire the ProviderService

```php
use OSW3\Search\Service\ProviderService;

// ...

public function __construct(
    private ProviderService $providerService
){}
```

<br>

### ProviderService Methods

#### getAll

Returns all providers names

`getAll(): array`

```php 
$this->providerService->getAll();
// [
//   0 => "first_provider"
//   1 => "seconde_provider"
// ]
```

<br>

#### setCurrent

Set the context provider

`setCurrent(string $name): static`

```php 
$this->providerService->setCurrent('second_provider');
```

<br>

#### getCurrent

Returns the name of the current context provider

`getCurrent(): string`

```php 
$this->providerService->getCurrent();
```

<br>

#### getOptions

Returns the configuration of a specific provider in `$provider` is not null

`getOptions(?string $provider=null): array`

```php 
$this->providerService->getOptions();
```

<br>

#### guessProvider

Return the name of the current provider base on the request parameter

`guessProvider(): null|string`

```php 
$this->providerService->guessProvider();
```

<br>


## QueryService

### Autowire the QueryService

```php
use OSW3\Search\Service\QueryService;

// ...

public function __construct(
    private QueryService $queryService
){}
```

<br>

### QueryService Methods

#### fetch

Prepare , execute and return the results of the query

`fetch(): array`

```php 
$this->queryService->fetch();
```

`fetch` is an alias of chained `$this->queryService->prepare()->execute()->getResults()`

<br>

#### prepare

Prepare the SQL request

`prepare(): static`

```php 
$this->queryService->prepare();
```

<br>

#### execute

Execute the SQL requests

`execute(): static`

```php 
$this->queryService->execute();
```

<br>

#### getResults

Return the results of the search query

`getResults(): array`

```php 
$this->queryService->getResults();
```

<br>

#### getTotal

Return the number of results

`getTotal(): int`

```php 
$this->queryService->getTotal();
```

<br>

## RequestService

### Autowire the RequestService

```php
use OSW3\Search\Service\RequestService;

// ...

public function __construct(
    private RequestService $requestService
){}
```

<br>

### RequestService Methods

#### getMethod

Returns the request method

`getMethod(): string`

```php 
$this->requestService->getMethod();
// GET
```

<br>

#### getParameter

Returns the request parameter

`getParameter(): string`

```php 
$this->requestService->getParameter();
// q
```

<br>

#### getExpression

Returns the searched expression

`getExpression(): string`

```php 
$this->requestService->getExpression();
```
<br>

#### getPreparationTime

Returns the request preparation timing

`getPreparationTime(): int`

```php 
$this->requestService->getPreparationTime();
```
<br>

#### getExecutionTime

Returns the request execution timing

`getExecutionTime(): int`

```php 
$this->requestService->getExecutionTime();
```


<br>

## ResultsService

### Autowire the ResultsService

```php
use OSW3\Search\Service\ResultsService;

// ...

public function __construct(
    private ResultsService $resultsService
){}
```

<br>

### ResultsService Methods

#### getTemplate

Returns the path of the results page template.

`getTemplate(): string`

```php 
$this->resultsService->getTemplate();
// "@Search/results/base.html"
```

<br>

#### getRoute

Returns the name of the results page route.

`getRoute(): string`

```php 
$this->resultsService->getRoute();
// app_search
```

<br>

#### getUrl

Returns the absolute or relative URL of the results page route.

`getUrl(bool $absolute=true): string`

```php 
$this->resultsService->getUrl();
// site.com/search
```

<br>

#### getPath

Returns the relative Path of the results page route.

Alias of `getUrl(false);`

`getPath(): string`

```php 
$this->resultsService->getPath();
// /search
```
