<?php

namespace TrainApp;

abstract class TrainCar {
    private int $weight;

    public function __construct($weight) {
        $this->weight = $weight;
    }

    public function setWeight($weight) : void {
        $this->weight = $weight;
    }

    public function getWeight() : int {
        return $this->weight;
    }

    public abstract function getType();
}