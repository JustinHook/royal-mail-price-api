<?php

require_once 'vendor/autoload.php';

use \RoyalMailPriceCalculator\Calculator;
use \RoyalMailPriceCalculator\Package;

$app = new \Slim\Slim();
$app->response->headers->set('Content-Type', 'application/json');
$app->config('debug', false);

$app->error(function (\Exception $e) use ($app) {
    $app->response->setStatus(400);
    echo json_encode(array(
        'message' => $e->getMessage()
    ));
});

$app->get('/', function() use ($app) {

    $length = $app->request->get('length');
    if (empty($length)) {
        throw new \Exception("Missing 'length' parameter.");
    }

    $width = $app->request->get('width');
    if (empty($width)) {
        throw new \Exception("Missing 'width' parameter.");
    }

    $depth = $app->request->get('depth');
    if (empty($depth)) {
        throw new \Exception("Missing 'depth' parameter.");
    }

    $weight = $app->request->get('weight');
    if (empty($depth)) {
        throw new \Exception("Missing 'weight' parameter.");
    }

    $services = $app->request->get('services');
    if (empty($services)) {
        throw new \Exception("Missing 'services' parameter.");
    }
    $services =  explode(",", $services);

    $calculator = new Calculator();

    $package = new Package();
    $package->setDimensions($length, $width, $depth);
    $package->setWeight($weight);

    $serviceClasses = array();

    $serviceClassMap = array(
        'firstclass' => '\RoyalMailPriceCalculator\Services\FirstClassService',
        'secondclass' => '\RoyalMailPriceCalculator\Services\SecondClassService',
        'signedforfirstclass' => '\RoyalMailPriceCalculator\Services\SignedForFirstClassService',
        'signedforsecondclass' => '\RoyalMailPriceCalculator\Services\SignedForSecondClassService',
        'guaranteedby9am' => '\RoyalMailPriceCalculator\Services\GuaranteedByNineAmService',
        'guaranteedby9amwithsaturday' => '\RoyalMailPriceCalculator\Services\GuaranteedByNineAmWithSaturdayService',
        'guaranteedby1pm' => '\RoyalMailPriceCalculator\Services\GuaranteedByOnePmService',
        'guaranteedby1pmwithsaturday' => '\RoyalMailPriceCalculator\Services\GuaranteedByOnePmWithSaturdayService',
    );

    foreach ($services as $service) {
        if (isset($serviceClassMap[strtolower($service)])) {
            $serviceClasses[] = new $serviceClassMap[strtolower($service)]();
        } else {
            throw new \Exception("Unknown service '$service'.");
        }
    }

    if (empty($serviceClasses)) {
        throw new \Exception("No valid services found.");
    }

    $calculator->setServices($serviceClasses);

    echo json_encode($calculator->calculatePrice($package), JSON_PRETTY_PRINT);
});



$app->run();