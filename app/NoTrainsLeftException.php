<?php

namespace TrainApp;

class NoTrainsLeftException extends \Exception
{
    protected $message = "There are no trains left to be removed";
}