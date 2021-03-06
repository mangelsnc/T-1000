<?php
require_once __DIR__.'/../../../autoloader.php';

use T1000\RoutePattern\ChronologicalRouter;
use T1000\RoutePattern\NoTargetException;

class ChronologicalRouterTest extends PHPUnit_Framework_TestCase
{
    public function testGetNext()
    {
        $router = new ChronologicalRouter();
        $targets = array(1,2,3,4);
        $origin = array(0,0);

        $result = $router->getNextTarget($origin, $targets);

        $this->assertEquals($result, 1);
    }

    public function testWithNoTargetsThrowsNoTargetException()
    {
        $router = new ChronologicalRouter();
        $targets = array();
        $origin = array(0,0);

        $this->setExpectedException("T1000\RoutePattern\NoTargetException");

        $result = $router->getNextTarget($targets);
        
    }
}