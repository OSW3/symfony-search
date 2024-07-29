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
// "search/form.html.twig"
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
    // Search/results/item.html
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

`getPage()`

<br>

#### getPages

`getPages()`

<br>

#### getLinks

`getLinks()`

<br>

#### getFirstLink

`getFirstLink()`

<br>

#### getLastLink

`getLastLink()`

<br>

#### getPrevLink

`getPrevLink()`

<br>

#### getNextLink

`getNextLink()`

<br>

#### getPerPage

`getPerPage()`

<br>

#### paginate

`paginate()`

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

`getAll()`

<br>

#### setCurrent

`setCurrent()`

<br>

#### getCurrent

`getCurrent()`

<br>

#### getOptions

`getOptions()`

<br>

#### guessProvider

`guessProvider()`

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

`fetch()`

<br>

#### prepare

`prepare()`

<br>

#### execute

`execute()`

<br>

#### getResults

`getResults()`

<br>

#### getTotal

`getTotal()`

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

`getMethod(): string`

#### getParameter

`getParameter(): string`

#### getExpression

`getExpression(): string`


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

`getTemplate(): string`

#### getRoute

`getRoute(): string`

#### getUrl

`getUrl(bool $absolute=true): string`

#### getPath

`getPath(): string`
