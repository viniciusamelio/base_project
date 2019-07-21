<?php
session_start();
include_once("vendor/autoload.php");

use \App\Templates;
$app = new \Slim\Slim();
$app->config('debug',true);

$app->get("/", function (){
    $template = new Templates();
});

$app->run();
