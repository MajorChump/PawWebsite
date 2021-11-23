<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../inc/config.php';

use \GuzzleHttp\Psr7\Request;
use \GuzzleHttp\Psr7\Response;

$app = \Slim\Factory\AppFactory::create();
$app->get('/', function (Request $request, Response $response) {
    return (new \Paw\Controller\IndexController($request, $response))->get();
});
$app->get('/distribution', function (Request $request, Response $response) {
    return (new \Paw\Controller\DistributionController($request, $response))->get();
});
$app->get('/email', function (Request $request, Response $response) {
    return (new \Paw\Controller\EmailController($request, $response))->get();
});
$app->post('/email', function (Request $request, Response $response) {
    return (new \Paw\Controller\EmailController($request, $response))->post();
});
$app->get('/receive', function (Request $request, Response $response) {
    return (new \Paw\Controller\ReceiveController($request, $response))->get();
});
$app->post('/recieve', function (Request $request, Response $response) {
    return (new \Paw\Controller\ReceiveController($request, $response))->post();
});
$app->run();