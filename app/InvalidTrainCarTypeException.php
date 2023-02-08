<?php

namespace TrainApp;

class InvalidTrainCarTypeException extends \Exception
{

    public function __construct($type) {
        $this->message = "Invalid train car type entered: $type";
    }
}