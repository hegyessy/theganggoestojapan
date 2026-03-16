<?php

require __DIR__ . '/vendor/autoload.php';

$kirby = new Kirby([
    'roots' => [
        'index'   => __DIR__,
        'site'    => __DIR__ . '/site',
        'content' => __DIR__ . '/content',
        'media'   => __DIR__ . '/media',
        'assets'  => __DIR__ . '/assets',
    ]
]);

echo $kirby->render();
