<?php
require_once '../../autoloader.php';
use T1000\T1000;

class T1000Test extends PHPUnit_Framework_TestCase
{
    private $firstTarget;
    private $secondTarget;
    private $routePattern;

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

        $this->routePattern = $this->getMock('T1000\RoutePattern', array('getNextTarget'));       
        $this->routePattern->expects($this->any())
                     ->method('getNextTarget')
                     ->with($this->isType('array'))
                     ->will($this->onConsecutiveCalls($this->firstTarget, $this->secondTarget));

    }

    public function testT1000ShouldRequestForTarget()
    {
        $t1000 = new T1000();
        
        $t1000->setRoutePattern($this->routePattern);
        $t1000->addTarget($this->firstTarget);
        $t1000->moveToTarget();
    }

    public function testT1000ShouldMoveToTarget()
    {
        $t1000 = new T1000();

        $t1000->setRoutePattern($this->routePattern);
        $t1000->addTarget($this->firstTarget);
        $t1000->moveToTarget();

        $this->assertEquals($t1000->getPosition(), $this->firstTarget->getPosition());
    }

    public function testT1000AttendsChronologically()
    {
        $t1000 = new T1000();

        $t1000->setRoutePattern($this->routePattern);
        $t1000->addTarget($this->firstTarget);
        $t1000->addTarget($this->secondTarget);
        
        $t1000->moveToTarget();
        $this->assertEquals($t1000->getPosition(), $this->firstTarget->getPosition());
        $t1000->moveToTarget();
        $this->assertEquals($t1000->getPosition(), $this->secondTarget->getPosition());
    }

    public function testT1000GetsNextTargetWhenLostFirst()
    {
        $t1000 = new T1000();
        
        $t1000->setRoutePattern($this->routePattern);
        $t1000->addTarget($this->firstTarget);
        $t1000->addTarget($this->secondTarget);

        $t1000->moveToTarget();
        $this->assertEquals($t1000->getPosition(), $this->firstTarget->getPosition());
        $t1000->targetLost();
        $this->assertEquals($t1000->getPosition(), $this->secondTarget->getPosition());

    }

    public function testT1000AttendsNearestTargetFirst()
    {
        $t1000 = new T1000();
        
        $t1000->setRoutePattern($this->routePattern);
        $t1000->addTarget($this->firstTarget);
        $t1000->addTarget($this->secondTarget);

        $t1000->moveToTarget();
        $this->assertEquals($t1000->getPosition(), $this->firstTarget->getPosition());
        $t1000->moveToTarget();
        $this->assertEquals($t1000->getPosition(), $this->secondTarget->getPosition());
    }
    
}