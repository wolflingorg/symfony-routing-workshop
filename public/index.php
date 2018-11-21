<?php
require_once '../vendor/autoload.php';

use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\HttpFoundation\Request;

$routeArticle = (new Route('/articles/{slug}'))
    ->setDefault('_callback', function ($slug) {
        echo sprintf('Hello from Article %s', $slug);
    })
    ->setRequirement('slug', '[0-9-]+')
    ->setCondition("request.headers.get('User-Agent') matches '/chrome/i'");

$collection = new RouteCollection();
$collection->add('articles-show', $routeArticle);

$request = Request::createFromGlobals();

$context = (new RequestContext())->fromRequest($request);

$matcher = new UrlMatcher($collection, $context);

try {
    $defaults = $matcher->matchRequest($request);
} catch (ResourceNotFoundException $e) {
    echo $e->getMessage();
}

print_r($defaults);

$defaults['_callback']($defaults['slug']);

