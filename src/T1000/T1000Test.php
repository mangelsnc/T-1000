<?php
require_once '../../autoloader.php';
use T1000\T1000;

class T1000Test extends PHPUnit_Framework_TestCase
{
    
    public function testT1000ShouldRequestForTarget()
    {
        $t1000 = new T1000();
        $target = $this->getMock('T1000\Target', array('getPosition'));
        $routePattern = $this->getMock('T1000\RoutePattern', array('getNextTarget'));
        $routePattern->expects($this->once())
                     ->method('getNextTarget')
                     ->with($this->anything())
                     ->will($this->returnValue($target));
        
        $t1000->setRoutePattern($routePattern);
        $t1000->addTarget($target);
        $t1000->moveToTarget();
    }

    public function testT1000ShouldMoveToTarget()
    {
        $t1000 = new T1000();
        
        $target = $this->getMock('T1000\Target', array('getPosition'));
        $target->expects($this->any())
               ->method('getPosition')
               ->will($this->returnValue(array(20, 30)));
        
        $routePattern = $this->getMock('T1000\RoutePattern', array('getNextTarget'));
        $routePattern->expects($this->once())
                     ->method('getNextTarget')
                     ->with($this->anything())
                     ->will($this->returnValue($target));

        $t1000->setRoutePattern($routePattern);
        $t1000->addTarget($target);
        $t1000->moveToTarget();

        $this->assertEquals($t1000->getPosition(), $target->getPosition());
    }

    public function testT1000AttendsChronologically()
    {
        $t1000 = new T1000();
        
        $firstTarget = $this->getMock('T1000\Target', array('getPosition'));
        $firstTarget->expects($this->any())
               ->method('getPosition')
               ->will($this->returnValue(array(20, 30)));

        $secondTarget = $this->getMock('T1000\Target', array('getPosition'));
        $secondTarget->expects($this->any())
               ->method('getPosition')
               ->will($this->returnValue(array(50, 60)));
        
        $routePattern = $this->getMock('T1000\RoutePattern', array('getNextTarget'));
        $routePattern->expects($this->any())
                     ->method('getNextTarget')
                     ->with($this->isType('array'))
                     ->will($this->onConsecutiveCalls($firstTarget, $secondTarget));

        $t1000->setRoutePattern($routePattern);
        $t1000->addTarget($firstTarget);
        $t1000->addTarget($secondTarget);
        
        $t1000->moveToTarget();
        $this->assertEquals($t1000->getPosition(), $firstTarget->getPosition());
        $t1000->moveToTarget();
        $this->assertEquals($t1000->getPosition(), $secondTarget->getPosition());
    }

    public function testT1000GetsNextTargetWhenLostFirst()
    {
        $t1000 = new T1000();

        $firstTarget = $this->getMock('T1000\Target', array('getPosition'));
        $firstTarget->expects($this->any())
            ->method('getPosition')
            ->will($this->returnValue(array(20,30)));

        $secondTarget = $this->getMock('T1000\Target', array('getPosition'));
        $secondTarget->expects($this->any())
            ->method('getPosition')
            ->will($this->returnValue(array(50,60)));

        $routePattern = $this->getMock('T1000\RoutePattern', array('getNextTarget'));
        $routePattern->expects($this->any())
                     ->method('getNextTarget')
                     ->with($this->isType('array'))
                     ->will($this->onConsecutiveCalls($firstTarget, $secondTarget));
        
        $t1000->setRoutePattern($routePattern);
        $t1000->addTarget($firstTarget);
        $t1000->addTarget($secondTarget);

        $t1000->moveToTarget();
        $this->assertEquals($t1000->getPosition(), $firstTarget->getPosition());
        $t1000->targetLost();
        $this->assertEquals($t1000->getPosition(), $secondTarget->getPosition());

    }

    public function testT1000AttendsNearestTargetFirst()
    {
        $t1000 = new T1000();

        $firstTarget = $this->getMock('T1000\Target', array('getPosition'));
        $firstTarget->expects($this->any())
            ->method('getPosition')
            ->will($this->returnValue(array(20,30)));

        $secondTarget = $this->getMock('T1000\Target', array('getPosition'));
        $secondTarget->expects($this->any())
            ->method('getPosition')
            ->will($this->returnValue(array(50,60)));

        $routePattern = $this->getMock('T1000\RoutePattern', array('getNextTarget'));
        $routePattern->expects($this->any())
                     ->method('getNextTarget')
                     ->with($this->isType('array'))
                     ->will($this->onConsecutiveCalls($firstTarget, $secondTarget));
        
        $t1000->setRoutePattern($routePattern);
        $t1000->addTarget($firstTarget);
        $t1000->addTarget($secondTarget);

        $t1000->moveToTarget();
        $this->assertEquals($t1000->getPosition(), $firstTarget->getPosition());
        $t1000->moveToTarget();
        $this->assertEquals($t1000->getPosition(), $secondTarget->getPosition());
    }
    
}