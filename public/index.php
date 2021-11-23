<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../inc/config.php';

$app = \Slim\Factory\AppFactory::create();
$app->get('/', function (\GuzzleHttp\Psr7\Request $request, \GuzzleHttp\Psr7\Response $response) {
    return (new \Paw\Controller\IndexController($request, $response))->get();
});
$app->get('/distribution', function (\GuzzleHttp\Psr7\Request $request, \GuzzleHttp\Psr7\Response $response) {
    return (new \Paw\Controller\DistributionController($request, $response))->get();
});
$app->get('/email', function (\GuzzleHttp\Psr7\Request $request, \GuzzleHttp\Psr7\Response $response) {
    return (new \Paw\Controller\EmailController($request, $response))->get();
});
$app->post('/email', function (\GuzzleHttp\Psr7\Request $request, \GuzzleHttp\Psr7\Response $response) {
    return (new \Paw\Controller\EmailController($request, $response))->post();
});
$app->get('/receive', function (\GuzzleHttp\Psr7\Request $request, \GuzzleHttp\Psr7\Response $response) {
    return (new \Paw\Controller\ReceiveController($request, $response))->get();
});
$app->post('/recieve', function (\GuzzleHttp\Psr7\Request $request, \GuzzleHttp\Psr7\Response $response) {
    return (new \Paw\Controller\ReceiveController($request, $response))->post();
});
$app->run();