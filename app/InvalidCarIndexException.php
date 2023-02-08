<?php

namespace TrainApp;

class InvalidCarIndexException extends \Exception
{
    public function __construct($requested, $actual)
    {
        $this->message = "Invalid car number requested.  You requested car number $requested but there are only $actual cars.";
    }
}