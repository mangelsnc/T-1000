<?php
namespace T1000\RoutePattern;

require  __DIR__ . "/../../../autoloader.php";

interface RoutePatternInterface
{
    public function getNextTarget($origin, $targets);
}