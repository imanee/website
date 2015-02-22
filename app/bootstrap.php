<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Little\Common\LittleApp;
use Little\Common\Provider\ControllerServiceProvider;

$app = new LittleApp(__DIR__ . '/../app/config.yml');
$app['debug'] = true;

$paths = [];

foreach ($app['config']['twig']['bundles'] as $bundle) {
    $paths[] = __DIR__ . '/../src/' . $bundle . '/Resources/views';
}

$app->register(new Silex\Provider\TwigServiceProvider(), [
    'twig.path' => $paths
]);

if (isset($app['config']['demos']) and $app['config']['demos']['enabled'] === 'yes') {
    $app->register(new \Little\Common\Provider\DemoServiceProvider(), [
        'demos.path' => $app['root'] . $app['config']['demos']['folder']
    ]);
}
