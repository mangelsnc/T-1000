<?php
namespace T1000;

require_once "../../autoloader.php";

use Symfony\Component\EventDispatcher\EventDispatcher as EventDispatcher;
use T1000\T1000Events as T1000Events;

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
        $target = $this->routePattern->getNextTarget($this->position, $this->targets);
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

    public function onTargetLostEvent()
    {
        $this->moveToTarget();
    }

    public function onNewTargetEvent($event)
    {
        $this->addTarget($event->getTarget());
    }

    public function registerEvents(EventDispatcher $dispatcher)
    {
        $dispatcher->addListener(T1000Events::NEW_TARGET, array($this, "onNewTargetEvent"));
        $dispatcher->addListener(T1000Events::TARGET_LOST, array($this, "onTargetLostEvent"));
    }
}
