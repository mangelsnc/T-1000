<?php
namespace T1000\RoutePattern;

require  __DIR__ . "/../../../autoloader.php";

use T1000\RoutePattern\RoutePatternInterface;
use T1000\RoutePattern\NoTargetException;

class DistanceRouter implements RoutePatternInterface
{
    const MAX_DISTANCE = 10000;

    public function getNextTarget($origin, $targets)
    {
        if(count($targets) == 0){
            throw new NoTargetException();
        }

        $max = self::MAX_DISTANCE;
        $next = null;

        foreach($targets as $target){
            $distance = $this->getDistance($origin, $target->getPosition());
            
            if($distance < $max){
                $max = $distance;
                $next = $target;
            }
        }

        return $next;
    }

    public function getDistance($origin, $target)
    {
        $x1 = $origin[0];
        $y1 = $origin[1];

        $x2 = $target[0];
        $y2 = $target[1];

        $primerParcial = pow(($x2 - $x1), 2);
        $segundoParcial = pow(($y2 - $y1), 2);

        $resultado = round(sqrt($primerParcial + $segundoParcial),2);

        return $resultado;
    }

}