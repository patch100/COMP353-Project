<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => __DIR__ . '/../logs/app.log',
        ],

        // Dev db settings
        'db' => [
            'host' => 'localhost',
            'user' => 'root',
            'pass' => 'root',
            'dbname' => 'nmc353_4',
        ],
        //Production db settings
        // 'db' => [
        //     'host' => 'nmc353_4.encs.concordia.ca',
        //     'user' => 'nmc353_4',
        //     'pass' => 'P4tr1ck1',
        //     'dbname' => 'nmc353_4',
        // ],
    ],
];
