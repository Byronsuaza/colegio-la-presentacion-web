<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$request = Illuminate\Http\Request::create('/', 'GET');
$response = $kernel->handle($request);
print_r($response->headers->all());

$mw = new \App\Http\Middleware\SecurityHeaders();
$testResp = $mw->handle(\Illuminate\Http\Request::create('/test', 'GET'), function($req){ return new \Illuminate\Http\Response('OK'); });
print_r($testResp->headers->all());
?>