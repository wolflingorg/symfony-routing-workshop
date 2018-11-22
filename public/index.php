<?php
require_once '../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\Loader\YamlFileLoader;
use Symfony\Component\Routing\Router;
use Symfony\Component\Routing\RequestContext;

$request = Request::createFromGlobals();

$fileLocator = new FileLocator(array(__DIR__));
$loader = new YamlFileLoader($fileLocator);
$context = (new RequestContext())->fromRequest($request);

$router = new Router(
    $loader,
    'routes.yaml',
    [
        'cache_dir' => '../cache'
    ],
    $context
);

$defaults = $router->matchRequest($request);

print_r($defaults);
