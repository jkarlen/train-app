<?php

$dirs = ['app', 'lib'];

foreach ($dirs as $dir) {
    require_once dirname(__FILE__) . '/../app/Train.php';
    require_once dirname(__FILE__) . '/../app/TrainCar.php';
    require_once dirname(__FILE__) . '/../app/TrainCarService.php';
    require_once dirname(__FILE__) . '/../app/PassengerTrainCar.php';
    require_once dirname(__FILE__) . '/../app/FreightTrainCar.php';
    require_once dirname(__FILE__) . '/../app/EngineTrainCar.php';
    require_once dirname(__FILE__) . '/../app/InvalidTrainCarTypeException.php';
    require_once dirname(__FILE__) . '/../app/InvalidCarIndexException.php';
    require_once dirname(__FILE__) . '/../app/NoTrainsLeftException.php';
    require_once dirname(__FILE__) . '/../app/TooManyCarsException.php';
    require_once dirname(__FILE__) . '/../app/App.php';
}