<?php

namespace TrainApp;

class Train {
    const TYPE_FREIGHT = 'FREIGHT';
    const TYPE_PASSENGER = 'PASSENGER';
    const TYPE_ENGINE = 'ENGINE';

    private array $car_types = [
        self::TYPE_ENGINE => 'EngineTrainCar',
        self::TYPE_FREIGHT => 'FreightTrainCar',
        self::TYPE_PASSENGER => 'PassengerTrainCar'
    ];

    /** @var TrainCar[] */
    private array $cars = [];

    /**
     * @param $type
     * @param $weight
     * @return void
     * @throws TooManyCarsException
     */
    public function addCarToFront($type, $weight) : void {
        if (count($this->cars) === 30) {
            throw new TooManyCarsException();
        }

        try {
            $car = $this->createTrainCar($type, $weight);
            array_unshift($this->cars, $car);
        } catch (InvalidTrainCarTypeException $ex) {
            echo $ex->getMessage() . "\n\n";
        }
    }

    /**
     * @param $type
     * @param $weight
     * @return void
     * @throws TooManyCarsException
     */
    public function addCarToRear($type, $weight) : void {
        if (count($this->cars) === 30) {
            throw new TooManyCarsException();
        }

        try {
            $car = $this->createTrainCar($type, $weight);
            $this->cars[] = $car;
        } catch (InvalidTrainCarTypeException $ex) {
            echo $ex->getMessage() . "\n\n";
        }
    }

    /**
     * @return void
     * @throws NoTrainsLeftException
     */
    public function removeCarFromFront() : void {
        if (count($this->cars) === 0) {
            throw new NoTrainsLeftException();
        }
        array_shift($this->cars);
    }

    /**
     * @return void
     * @throws NoTrainsLeftException
     */
    public function removeCarFromRear() : void {
        if (count($this->cars) === 0) {
            throw new NoTrainsLeftException();
        }
        array_pop($this->cars);
    }

    /**
     * @param $car_number
     * @return CarInfo
     * @throws \TrainApp\InvalidCarIndexException
     */
    public function getCarDetails($car_number) : CarInfo {
        $car = $this->getTrainCar($car_number); // so we can prompt users from a 1-based list
        $info = new CarInfo();
        $info->weight = $car->getWeight();
        $info->type = $car->getType();

        return $info;
    }

    /**
     * @param $car_number
     * @param $weight
     * @return void
     * @throws \TrainApp\InvalidCarIndexException
     */
    public function setCarWeight($car_number, $weight) : void {
        $car = $this->getTrainCar($car_number);
        $car->setWeight($weight);
    }

    /**
     * @return int
     */
    public function getTotalWeight() :int {
        $weight = 0;
        array_map(
            function (TrainCar $trainCar) use (&$weight) {
                $weight += $trainCar->getWeight();
            },
            $this->cars
        );

        return $weight;
    }

    /**
     * @return array
     */
    public function getTrainCarTypes() : array {
        return array_keys($this->car_types);
    }

    /**
     * @param $car_number
     * @return \TrainApp\TrainCar
     * @throws \TrainApp\InvalidCarIndexException
     */
    private function getTrainCar($car_number) : TrainCar {
        $index = $car_number - 1; // allows user to enter numbers based on a 1-based list

        if(count($this->cars) < $car_number) {
            throw new InvalidCarIndexException($car_number, count($this->cars));
        }

        return $this->cars[$index];
    }

    /**
     * @param $type
     * @param $weight
     * @return mixed
     * @throws InvalidTrainCarTypeException
     */
    private function createTrainCar($type, $weight) : TrainCar {
        return TrainCarService::create($type, $weight, $this->car_types);
    }
}

class CarInfo {
    public string $type;
    public int $weight;
}