# Chiphpotle

## PHP REST API Client for SpiceDB

[SpiceDB](https://github.com/authzed/spicedb) is a database for creating and managing security-critical application permissions.
Chiphpotle is a PHP client for their rest API. For more information, please visit [https://github.com/authzed/api](https://github.com/authzed/api).

## Requirements

Supports PHP 8.1 and newer, and supports SpiceDB 1.30 and above.

## Installation with Composer

```shell
composer require alsbury/chiphpotle-rest
```

## Getting Started

### Initialize Client

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiClient = Client::create('http://spicedb:8443/', 'mysecret');

$request = new CheckPermissionRequest(
    ObjectReference::create('user', 'bob'),
    'view',
    SubjectReference::create('document', 'topsecret1'),
);
try {
    $response = $apiClient->checkPermission($request);
    if ($response->getPermissionship() == Permissionship::HAS_PERMISSION) {
        echo 'You may Pass!'
    }
} catch (Exception $e) {
    echo 'Exception when calling PermissionsServiceApi->permissionsServiceCheckPermission: ', $e->getMessage(), PHP_EOL;
}
```

## Experimental APIs

Included in the client are three experimental APIs. Though SpiceDB advertised these APIs im 1.25 and earlier,
they did not work in the http gateway. This had been fixed, in versions 1.26 and above. In SpiceDB 1.30 the check bulk
permissions graduated and the experimental api was deprecated.

## Tests

copy .env.dist to .env and adjust the BASE_URL and API_KEY. Spicedb must be running on the url specified, 
we recommend running using the [serve-testing](https://authzed.com/docs/guides/validation-and-testing#testing-code-against-spicedb) mode.


To run the tests, start use:

```bash
composer install
spicedb serve-testing --http-enabled
vendor/bin/phpunit
```

## Code Generation

This client was created by starting with an auto-generated client from the open-api json schema provided by spicedb using [jane-openapi](https://jane.readthedocs.io/en/latest/documentation/OpenAPI.html).

Once SpiceDB is running, you can regenerate all the classes and client to pick up any new spicedb apis by running:

```bash
vendor/bin/jane-openapi generate
```

This generates the client in a generated directory which then can be cleaned up and moved over to the src directory.
To get a good start run PHP CS Fixer to format things more consistently.

```bash
vendor/bin/php-cs-fixer fix
```
