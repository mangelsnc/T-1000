<?php
require_once __DIR__.'/../../../autoloader.php';

use T1000\RoutePattern\DistanceRouter;
use T1000\RoutePattern\NoTargetException;

class DistanceRouterTest extends PHPUnit_Framework_TestCase
{
    private $targets;
    private $firstTarget;
    private $secondTarget;
    private $thirdTarget;
    private $origin;

    public function setUp()
    {
        $this->firstTarget = $this->getMock('T1000\Target', array('getPosition'));
        $this->firstTarget->expects($this->any())
               ->method('getPosition')
               ->will($this->returnValue(array(20, 30)));

        $this->secondTarget = $this->getMock('T1000\Target', array('getPosition'));
        $this->secondTarget->expects($this->any())
               ->method('getPosition')
               ->will($this->returnValue(array(50, 60)));
        $this->thirdTarget = $this->getMock('T1000\Target', array('getPosition'));
        $this->thirdTarget->expects($this->any())
               ->method('getPosition')
               ->will($this->returnValue(array(10, 10)));       

        $this->targets = array($this->firstTarget, $this->secondTarget, $this->thirdTarget);

        $this->origin = array(0,0);
    }

    public function testGetNextTarget()
    {
        $router = new DistanceRouter();

        $result = $router->getNextTarget($this->origin, $this->targets);

        $this->assertEquals($result->getPosition(), $this->thirdTarget->getPosition());
    }

    public function testGetDistance()
    {
        $router = new DistanceRouter();

        $result = $router->getDistance(
                $this->origin, 
                $this->firstTarget->getPosition()
        );

        $this->assertEquals(36, floor($result));
    }

    public function testWithNoTargetsThrowsNoTargetException()
    {
        $router = new DistanceRouter();
        $targets = array();
        
        $this->setExpectedException("T1000\RoutePattern\NoTargetException");

        $result = $router->getNextTarget($this->origin, $targets);
        
    }
}