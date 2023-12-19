<?php

/*
 * Laraca config
 */
return [
    /*
    |--------------------------------------------------------------------------
    | Cast Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Casts will be generated.
    |
    */
    'cast' => [
        'path' => app_path('Data/Casts'),
        'namespace' => app()->getNamespace().'Data\\Casts',
    ],

    /*
    |--------------------------------------------------------------------------
    | Channel Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Channels will be generated.
    |
    */
    'channel' => [
        'path' => app_path('Broadcasting'),
        'namespace' => app()->getNamespace().'Broadcasting',
    ],

    /*
    |--------------------------------------------------------------------------
    | Command Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Commands will be generated.
    |
    */
    'command' => [
        'path' => app_path('Console/Commands'),
        'namespace' => app()->getNamespace().'Console\\Commands',
    ],

    /*
    |--------------------------------------------------------------------------
    | Component Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Components will be generated.
    |
    */
    'component' => [
        'path' => app_path('View/Components'),
        'namespace' => app()->getNamespace().'View\\Components',
    ],

    /*
    |--------------------------------------------------------------------------
    | Controller Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Controllers will be generated.
    |
    */
    'controller' => [
        'path' => app_path('Http/Controllers'),
        'namespace' => app()->getNamespace().'Http\\Controllers',
    ],

    /*
    |--------------------------------------------------------------------------
    | Event Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Events will be generated.
    |
    */
    'event' => [
        'path' => app_path('Events'),
        'namespace' => app()->getNamespace().'Events',
    ],

    /*
    |--------------------------------------------------------------------------
    | Model Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Models will be generated.
    |
    */
    'model' => [
        'path' => app_path('Data/Models'),
        'namespace' => app()->getNamespace().'Data\\Models',
    ],
];
