<?php
require_once('vendor/Symfony/Component/ClassLoader/UniversalClassLoader.php');

use Symfony\Component\ClassLoader\UniversalClassLoader;

$loader = new UniversalClassLoader();

$loader->registerNamespace("T1000", __DIR__.'/src');
$loader->registerNamespace("T1000\\NeuronalRoutine", __DIR__.'/src/T1000/NeuronalRoutine');
$loader->registerNamespace("T1000\\RoutePattern", __DIR__.'/src/T1000/RoutePattern');
$loader->registerNamespace("T1000\\Target", __DIR__.'/src/T1000/Target');

$loader->register();
