<?php

namespace TrainApp;

class TrainCarService {
    public static function create($carType, $weight, $allowedCarTypes = []) {
        if (!in_array($carType, array_keys($allowedCarTypes))) {
            throw new \TrainApp\InvalidTrainCarTypeException($carType);
        }

        $class = '\\TrainApp\\' . $allowedCarTypes[$carType];
        return new $class($weight);
    }
}