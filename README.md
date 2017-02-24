# Google URL Shortener API

Simple PHP library for Google URL Shortener API

## Getting Started

### Composer
```bash
composer require h2akim/googl:*
```

## How to Use

#### Create a new shorten URL
Parameters available:
* shortUrl
* object _(optional)_ - return as object (if true)

```php
namespace H2akim\Googl;

$googl = new Googl('your-api-key');

$googl->create([
    'shortUrl' => 'http://url.that.you.want.com'
]);
```

#### Retrieve original url from shorten URL
Parameters available:
* longUrl
* projection - _ANALYTICS_CLICKS / ANALYTICS_TOP_STRINGS / FULL_
* object _(optional)_ - return as object (if true)

```php
namespace H2akim\Googl;

$googl = new Googl('your-api-key');

$googl->expand([
    'longUrl' => 'http://goo.gl/short-url'
]);
```
