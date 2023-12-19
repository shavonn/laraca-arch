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
