<?php

$settings = [];

// Slim settings
$settings['displayErrorDetails'] = true;
$settings['determineRouteBeforeAppMiddleware'] = true;

// Path settings
$settings['root'] = dirname(__DIR__);
$settings['temp'] = $settings['root'] . '/tmp';
$settings['public'] = $settings['root'] . '/public';

// View settings
$settings['twig'] = [
    'path' => $settings['root'] . '/templates',
    'cache_enabled' => false,
    'cache_path' =>  $settings['temp'] . '/twig-cache'
];

// Database settings
$settings['db']['host'] = '172.24.0.3';
$settings['db']['username'] = 'root';
$settings['db']['password'] = 'root';
$settings['db']['database'] = 'forecast';
$settings['db']['charset'] = 'utf8';
$settings['db']['collation'] = 'utf8_unicode_ci';

// OpenWheater settings
$settings['ow']['apiKey'] = '5660a233b8792be95c5e75b3c93d1de4';
$settings['ow']['url'] = 'https://api.openweathermap.org/data/2.5/weather?';

return $settings;