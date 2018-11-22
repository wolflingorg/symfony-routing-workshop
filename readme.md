# Run server

```php -S 0.0.0.0:8080 index.php```

# 01-home-page-route

```git checkout 01-home-page-route```

- Simple static route
- Context and Request object

```composer require symfony/http-foundation```

- Generate route by name


# 02-non-static-route

```git checkout 01-home-page-route```

- Non-static route
- Non-static route and requirements
- Non-static route and conditions

```composer require symfony/expression-language```

```"request.headers.get('User-Agent') matches '/chrome/i'"```

# 03-yaml-file

```git checkout 03-yaml-file```

- Load routes from config

```composer require symfony/config```

```composer require symfony/yaml```

**routes.yaml**
```
articles:
  path:     /articles
  defaults: { _callable: 'articles' }
articles-show:
  path:     /articles/{slug}
  defaults: { _callable: 'articlesShow' }
```

```
$fileLocator = new FileLocator(array(__DIR__));
$loader = new YamlFileLoader($fileLocator);
$collection = $loader->load('routes.yaml');
```

# 04-matcher-dumper

```git checkout 04-matcher-dumper```

- How to dump routes

```
$dumper = new PhpMatcherDumper($collection);
echo $dumper->dump();
```

# 05-router-all-in-one

```git checkout 05-router-all-in-one```

- Router class

```
$router = new Router(
    $loader,
    'routes.yaml',
    [
        'cache_dir' => '../cache'
    ],
    $context
);
```
