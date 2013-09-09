<?php
namespace T1000\Target;

require_once __DIR__."/../../../autoloader.php";

class Target
{
    private $position;

    public function __construct(array $position)
    {
        $this->position = $position;
    }

    public function getPosition()
    {
        return $this->getPosition();
    }
}