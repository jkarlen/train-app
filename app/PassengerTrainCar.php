<?php

namespace TrainApp;

class PassengerTrainCar extends TrainCar
{
    /**
     * @return string
     */
    public function getType() : string
    {
        return 'PASSENGER';
    }
}