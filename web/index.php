<?php

use Imanee\Imanee;

require_once __DIR__.'/../app/bootstrap.php';

/* ROUTES */

$app->get('/', function () use ($app) {
    return $app['twig']->render('index.html.twig', array(
        'demos' => $app['demos.loader']->getDemosMetaData(),
    ));
});

$app->get('/demo/{slug}', function ($slug) use ($app) {

    $file = __DIR__ . '/demos/scripts/' . $slug . '.php';

    if (!is_file($file)) {
        throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException();
    }

    $loader = $app['demos.loader'];

    return $app['twig']->render('demo.html.twig', array(
        'metadata' => $loader->load($file)
    ));
});

$app->get('/test', function () use ($app) {
    $loader = $app['demos.loader'];

    print_r($loader->load(__DIR__ . '/demos/scripts/thumbnail01.php'));
});

$app->get('/demo/run/{slug}', function ($slug) use ($app) {

    $file = __DIR__ . '/demos/scripts/' . $slug . '.php';

    if (!is_file($file)) {
        throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException();
    }

    include($file);
});

$app->run();
