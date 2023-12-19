<?php

/*
 * Laraca config
 */
return [

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
