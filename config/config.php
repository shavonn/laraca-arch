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
    | Exception Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Exceptions will be generated.
    |
    */
    'exception' => [
        'path' => app_path('Exceptions'),
        'namespace' => app()->getNamespace().'Exceptions',
    ],

    /*
    |--------------------------------------------------------------------------
    | Factory Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Factories will be generated.
    |
    */
    'factory' => [
        'path' => app_path('database/factories'),
        'namespace' => app()->getNamespace().'Database\\Factories',
    ],

    /*
    |--------------------------------------------------------------------------
    | Job Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Jobs will be generated.
    |
    */
    'job' => [
        'path' => app_path('Jobs'),
        'namespace' => app()->getNamespace().'Jobs',
    ],

    /*
    |--------------------------------------------------------------------------
    | Listener Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Listeners will be generated.
    |
    */
    'listener' => [
        'path' => app_path('Listeners'),
        'namespace' => app()->getNamespace().'Listeners',
    ],

    /*
    |--------------------------------------------------------------------------
    | Mail Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Mails will be generated.
    |
    */
    'mail' => [
        'path' => app_path('Mail'),
        'namespace' => app()->getNamespace().'Mail',
    ],

    /*
    |--------------------------------------------------------------------------
    | Middleware Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Middleware will be generated.
    |
    */
    'middleware' => [
        'path' => app_path('Http/Middleware'),
        'namespace' => app()->getNamespace().'Http\\Middleware',
    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Migrations will be generated.
    |
    */
    'migration' => [
        'path' => base_path('database/migrations'),
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

    /*
    |--------------------------------------------------------------------------
    | Notification Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Notifications will be generated.
    |
    */
    'notification' => [
        'path' => app_path('Notifications'),
        'namespace' => app()->getNamespace().'Notifications',
    ],

    /*
    |--------------------------------------------------------------------------
    | Observer Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Observers will be generated.
    |
    */
    'observer' => [
        'path' => app_path('Data/Observers'),
        'namespace' => app()->getNamespace().'Data\\Observers',
    ],

    /*
    |--------------------------------------------------------------------------
    | Policy Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Policies will be generated.
    |
    */
    'policy' => [
        'path' => app_path('Policies'),
        'namespace' => app()->getNamespace().'Policies',
    ],

    /*
    |--------------------------------------------------------------------------
    | Provider Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Providers will be generated.
    |
    */
    'provider' => [
        'path' => app_path('Providers'),
        'namespace' => app()->getNamespace().'Providers',
    ],

    /*
    |--------------------------------------------------------------------------
    | Request Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Requests will be generated.
    |
    */
    'request' => [
        'path' => app_path('Http/Requests'),
        'namespace' => app()->getNamespace().'Http\\Requests',
    ],
];
