<?php
use Cake\Routing\Router;
Router::plugin(
    'Log',
    ['path' => '/log'],
    function ($routes) {
        $routes->fallbacks('DashedRoute');
    }
);
