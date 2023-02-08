<?php

namespace TrainApp;

class TooManyCarsException extends \Exception
{
    protected $message = "The maximum number of cars has been reached";
}