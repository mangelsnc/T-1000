<?php
namespace T1000;

require_once "../../autoloader.php";

use T1000\RoutePattern\RoutePattern as RoutePattern;

class T1000
{
    private $targets;
    private $position;
    private $routePattern;

    public function __construct()
    {
        $this->targets = array();
        $this->position = array(0,0);
        $this->routePattern = null;
    }

    public function addTarget($target)
    {
        $this->targets []= $target;
    }

    public function moveToTarget()
    {
        $target = $this->routePattern->getNextTarget($this->targets);
        $this->position = $target->getPosition();
    }

    public function getPosition()
    {
        return $this->position;
    }

    public function setRoutePattern($routePattern)
    {
        $this->routePattern = $routePattern;
    }
}