<?php
require_once '../vendor/autoload.php';

use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

$routeHome = (new Route('/'))
    ->setDefault('_callback', function () {
        echo 'Hello from home';
    });

$collection = new RouteCollection();
$collection->add('home', $routeHome);

$context = new RequestContext('/', 'GET', 'localhost');

$matcher = new UrlMatcher($collection, $context);

try {
    $defaults = $matcher->match('/');
} catch (ResourceNotFoundException $e) {
    echo $e->getMessage();
}

print_r($defaults);

$defaults['_callback']();
