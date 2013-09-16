<?php
namespace T1000\RoutePattern;

require_once __DIR__.'/../../../autoloader.php';

class NoTargetException extends \Exception
{
    public function __construct() {
        parent::__construct("There's no targets", 100, null);
    }

    public function __toString() {
        return __CLASS__;
    }
}