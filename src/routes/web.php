<?php

use App\Services\Broker;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $configs = config('services.mqtt');

    $broker = new Broker($configs);

    $broker->subscribe('#', function ($topic, $message) {
        echo 'Received message: ' . $message . ' on topic: ' . $topic . PHP_EOL;
    });

    $broker->loop();
});
