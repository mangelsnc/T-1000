<?php
namespace T1000\RoutePattern;

require  __DIR__ . "/../../../autoloader.php";

class DistanceRouter implements RoutePattern
{
    public function getNextTarget($targets)
    {
        return $targets[0];
    }
}