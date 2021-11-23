<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/logic/inc/functions.inc.php';
require __DIR__ . '/logic/inc/config.php';

$app = \Slim\Factory\AppFactory::create();
$app->get('/', function (\GuzzleHttp\Psr7\Request $request, \GuzzleHttp\Psr7\Response $response) {
    return (new \Paw\Controller($request, $response))->index();
});
$app->get('/distribution', function (\GuzzleHttp\Psr7\Request $request, \GuzzleHttp\Psr7\Response $response) {
    return (new \Paw\Controller($request, $response))->distribution();
});
$app->run();

/*
require('logic/inc/config.php');
require('logic/inc/db.inc.php');
require('logic/inc/node.inc.php');
require('logic/inc/functions.inc.php');*/