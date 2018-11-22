<?php
namespace src;

require_once '../vendor/autoload.php';

use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\Loader\YamlFileLoader;
use Symfony\Component\Routing\Matcher\Dumper\PhpMatcherDumper;

$fileLocator = new FileLocator(array(__DIR__));
$loader = new YamlFileLoader($fileLocator);
$collection = $loader->load('routes.yaml');

$dumper = new PhpMatcherDumper($collection);
echo $dumper->dump();
