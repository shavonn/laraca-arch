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
    | This value is the path where Models will be generated.
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
    | This value is the path where Models will be generated.
    |
    */
    'channel' => [
        'path' => app_path('Broadcasting'),
        'namespace' => app()->getNamespace().'Broadcasting',
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
