<?php
namespace T1000;

use Symfony\Component\EventDispatcher\Event as Event;

class NewTargetEvent extends Event
{
    private $target;

    public function __construct(Target $target)
    {
        $this->target = $target;
    }

    public function getTarget()
    {
        return $this->target;
    }
}