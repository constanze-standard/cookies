# Constanze Standard: Cookies
Cookie support for PSR-7 response.

## Installation
```sh
composer require constanze-standard/cookies
```

## Usage
Add a Cookie to collection with `addCookie`.
```php
use ConstanzeStandard\Cookies\Cookie;
use ConstanzeStandard\Cookies\CookieCollection;

$cookie = new Cookie('name', 'value', 60);

$cookieCollection = new CookieCollection();
$cookieCollection->addCookie($cookie);
```

Or you can add cookie with `add`, it will return the new created `Cookie` instance:
```php
use ConstanzeStandard\Cookies\CookieCollection;

$cookieCollection = new CookieCollection();
/** @var \ConstanzeStandard\Cookies\Cookie $cookie */
$cookie = $cookieCollection->add('name', 'value', 60);
```

Cookie's arguments:
- `string $name` The name of the cookie.
- `string $value` The value of the cookie.
- `int $expireTime` The time of cookie expires relatively to current timestamp.
- `string $path` The path on the server in which the cookie will be available on.
- `string $domain` The (sub)domain that the cookie is available to.
- `bool $secure` Indicates that the cookie should only be transmitted over a secure HTTPS connection from the client.
- `bool $httponly` When TRUE the cookie will be made accessible only through the HTTP protocol.

Set cookies for PSR-7 response:
```php
/** @var \Psr\Http\Message\ResponseInterface $response */
$cookieCollection->makeResponse($response);
```
