<?php
namespace T1000\RoutePattern;

require  __DIR__ . "/../../../autoloader.php";
use T1000\RoutePattern\NoTargetException;

class ChronologicalRouter implements RoutePatternInterface
{
    public function getNextTarget($targets)
    {
        if(count($targets) == 0){
            throw new NoTargetException();
        }   

        return $targets[0]; 
    }
}