<?php
namespace src;

require_once '../vendor/autoload.php';

use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\Loader\YamlFileLoader;

$fileLocator = new FileLocator(array(__DIR__));
$loader = new YamlFileLoader($fileLocator);
$collection = $loader->load('routes.yaml');

$request = Request::createFromGlobals();

$context = (new RequestContext())->fromRequest($request);

$matcher = new UrlMatcher($collection, $context);

try {
    $defaults = $matcher->matchRequest($request);

    print_r($defaults);
} catch (ResourceNotFoundException $e) {
    echo $e->getMessage();
}
