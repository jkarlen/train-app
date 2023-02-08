<?php

namespace TrainApp;

use TrainApp\TrainCar as TrainCar;

class EngineTrainCar extends TrainCar
{
    /**
     * @return string
     */
    public function getType() : string
    {
        return 'ENGINE';
    }
}