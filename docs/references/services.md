# Services Methods

<br>

## EntityService

### Autowire rhe EntityService

```php
use OSW3\Search\Service\EntityService;

// ...

public function __construct(
    private EntityService $entityService
){}
```

<br>

### EntityService Methods

#### getAll

`getAll(): array`

Return the part "entities" of the `search.yaml` config

<br>

#### exclude

`exclude(string $entity): static`

Add entity to the exclusion list

<br>

#### queryable

`queryable(): array`

Return the list of queryable entities

<br>

#### getOptions

`getOptions(string $entity): array`

Return options for a specific entity

<br>

## FormService

### Autowire rhe FormService

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

`getTemplate()`

<br>

## ItemService

### Autowire rhe ItemService

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

`setEntity()`

<br>

#### getEntity

`getEntity()`

<br>

#### getClass

`getClass()`

<br>

#### getAlias

`getAlias()`

<br>

#### getTemplate

`getTemplate()`

<br>

#### getOptions

`getOptions()`

<br>

#### getRoute

`getRoute()`

<br>

#### getRouteParams

`getRouteParams()`

<br>

#### getUrl

`getUrl()`

<br>

#### getPath

`getPath()`

<br>

#### getTitle

`getTitle()`

<br>

#### getDescription

`getDescription()`

<br>

#### getIllustration

`getIllustration()`

<br>

#### getProperty

`getProperty()`

<br>

## PaginationService

### Autowire rhe PaginationService

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

### Autowire rhe ProviderService

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

### Autowire rhe QueryService

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

### Autowire rhe RequestService

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

### Autowire rhe ResultsService

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
