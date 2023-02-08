<?php

namespace TrainApp;

class FreightTrainCar extends TrainCar
{
    /**
     * @return string
     */
    public function getType() : string
    {
        return 'FREIGHT';
    }
}