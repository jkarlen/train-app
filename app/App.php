<?php

namespace TrainApp;

class App {
    private Train $train;
    private array $commands = [
        1 => ['name' => 'Remove lead car', 'function' => 'removeLeadCar'],
        2 => ['name' => 'Remove last car', 'function' => 'removeLastCar'],
        3 => ['name' => 'Add a car to the front of the train', 'function' => 'addCarToFront'],
        4 => ['name' => 'Add a car to the rear of the train', 'function' => 'addCarToRear'],
        5 => ['name' => 'Set the weight of a car', 'function' => 'setCarWeight'],
        6 => ['name' => 'Get details about a specific car', 'function' => 'getCarDetails'],
        7 => ['name' => 'Get the total weight of the train', 'function' => 'getTotalWeight'],
        8 => ['name' => 'Exit', 'function' => 'sayGoodBye'],
    ];

    public function __construct() {
        $this->train = new Train();
    }

    public function execute() : void {
        $this->promptForCommand();
    }

    private function promptForCommand() : void {
        $this->drawMenu();
        $command = readline("\nPlease enter you selection: ");
        $this->{$this->commands[$command]['function']}();
        $this->promptForCommand();
    }

    private function removeLeadCar() : void {
        try {
            $this->train->removeCarFromFront();
        } catch (NoTrainsLeftException $ex) {
            echo $ex->getMessage() . "\n\n";
        }

    }

    private function removeLastCar() : void {
        try {
            $this->train->removeCarFromRear();
        } catch (NoTrainsLeftException $ex) {
            echo $ex->getMessage() . "\n\n";
        }
    }

    private function addCarToFront() : void {
        try {
            $info = $this->promptForNewTrainCarData();
            $this->train->addCarToFront($info->type, $info->weight);
        } catch(TooManyCarsException $ex) {
            echo $ex->getMessage() . "\n\n";
        }
    }

    private function addCarToRear() : void {
        try {
            $info = $this->promptForNewTrainCarData();
            $this->train->addCarToRear($info->type, $info->weight);
        } catch(TooManyCarsException $ex) {
            echo $ex->getMessage() . "\n\n";
        }
    }

    private function getCarDetails() : void {
        $car_number = readline("Please enter a car number: ");

        try {
            $details = $this->train->getCarDetails($car_number);
            echo "Car number $car_number is a {$details->type} car weighing {$details->weight} pounds\n\n";
        } catch (InvalidCarIndexException $ex) {
            echo $ex->getMessage() . "\n\n";
        }
    }

    private function setCarWeight() : void {
        $car_number = readline("Please enter a car number: ");
        $weight = readline("Please enter car $car_number's weight: ");

        try {
            $this->train->setCarWeight($car_number, $weight);
        } catch (InvalidCarIndexException $ex) {
            echo $ex->getMessage() . "\n\n";
        }
    }

    private function getTotalWeight() : void {
        $tons = $this->train->getTotalWeight()/2000;
        echo "The train's total weight is $tons tons.\n\n";
    }

    private function promptForNewTrainCarData() : NewTrainCarData {
        $info = new NewTrainCarData();
        $info->type = readline("Please enter type type [must be one of " . implode(',', $this->train->getTrainCarTypes()) . "] ");
        $info->weight = readline("Please enter the car's weight in pounds ");

        return $info;
    }

    private function drawMenu() : void {
        echo "Please select from one of the following options:\n\n";

        foreach ($this->commands as $command_id => $command) {
            echo "\t$command_id: {$command['name']}\n";
        }
    }

    private function sayGoodBye() {
        echo "Thank you so much for using TrainApp.  Goodbye.\n";
        exit;
    }
}

class NewTrainCarData {
    public string $type;
    public int $weight;
}