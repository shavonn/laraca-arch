<?php

/*
 * Laraca config
 */
return [
    /*
    |--------------------------------------------------------------------------
    | Database Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Factories will be generated.
    |
    */
    'database' => [
        'path' => 'database',
        'parent' => 'base',
    ],

    /*
    |--------------------------------------------------------------------------
    | Cast Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Casts will be generated.
    |
    */
    'cast' => [
        'path' => 'Data/Casts',
        'parent' => 'app',
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
        'path' => 'Broadcasting',
        'parent' => 'app',
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
        'path' => 'Console/Commands',
        'parent' => 'app',
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
        'path' => 'View/Components',
        'parent' => 'app',
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
        'path' => 'Http/Controllers',
        'parent' => 'app',
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
        'path' => 'Events',
        'parent' => 'app',
    ],

    /*
    |--------------------------------------------------------------------------
    | Enum Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Enums will be generated.
    |
    */
    'enum' => [
        'path' => 'Enums',
        'parent' => 'app',
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
        'path' => 'Exceptions',
        'parent' => 'app',
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
        'path' => 'factories',
        'parent' => 'database',
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
        'path' => 'Jobs',
        'parent' => 'app',
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
        'path' => 'Listeners',
        'parent' => 'app',
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
        'path' => 'Mail',
        'parent' => 'app',
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
        'path' => 'Http/Middleware',
        'parent' => 'app',
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
        'path' => 'migrations',
        'parent' => 'database',
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
        'path' => 'Data/Models',
        'parent' => 'app',
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
        'path' => 'Notifications',
        'parent' => 'app',
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
        'path' => 'Data/Observers',
        'parent' => 'app',
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
        'path' => 'Policies',
        'parent' => 'app',
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
        'path' => 'Providers',
        'parent' => 'app',
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
        'path' => 'Http/Requests',
        'parent' => 'app',
    ],

    /*
    |--------------------------------------------------------------------------
    | Resource Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Resources will be generated.
    |
    */
    'resource' => [
        'path' => 'Http/Resources',
        'parent' => 'app',
    ],

    /*
    |--------------------------------------------------------------------------
    | Rule Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Rules will be generated.
    |
    */
    'rule' => [
        'path' => 'Rules',
        'parent' => 'app',
    ],

    /*
    |--------------------------------------------------------------------------
    | Scope Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Scopes will be generated.
    |
    */
    'scope' => [
        'path' => 'Scopes',
        'parent' => 'model',
    ],

    /*
    |--------------------------------------------------------------------------
    | Seeder Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Seeders will be generated.
    |
    */
    'seeder' => [
        'path' => 'seeders',
        'parent' => 'database',
    ],

    /*
    |--------------------------------------------------------------------------
    | Test Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Tests will be generated.
    */
    'test' => [
        'path' => 'tests',
        'parent' => 'base',
    ],

    /*
    |--------------------------------------------------------------------------
    | Value Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Values will be generated.
    |
    */
    'value' => [
        'path' => 'Data/Values',
        'parent' => 'app',
    ],

    /*
    |--------------------------------------------------------------------------
    | View Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Views will be generated.
    |
    */
    'view' => [
        'path' => 'resources/views',
        'parent' => 'base',
    ],
];
