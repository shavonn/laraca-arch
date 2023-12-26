<?php

/*
 * Laraca config
 *
 * parent => [key of another element || base || app]
 * base = project root dir
 * app = app root dir
 *
 */
return [
    /*
    |--------------------------------------------------------------------------
    | Database Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Factories will be generated.
    | Requires 'path' key.
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
    | Requires 'namespace' key.
    | Path after App\ root namespace.
    |
    */
    'cast' => [
        'namespace' => 'Data\Casts',
        'parent' => 'app',
    ],

    /*
    |--------------------------------------------------------------------------
    | Channel Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Channels will be generated.
    | Requires 'namespace' key.
    | Path after App\ root namespace.
    |
    */
    'channel' => [
        'namespace' => 'Broadcasting',
        'parent' => 'app',
    ],

    /*
    |--------------------------------------------------------------------------
    | Command Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Commands will be generated.
    | Requires 'namespace' key.
    | Path after App\ root namespace.
    |
    */
    'command' => [
        'namespace' => 'Console\Commands',
        'parent' => 'app',
    ],

    /*
    |--------------------------------------------------------------------------
    | Component Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Components will be generated.
    | Requires 'namespace' key.
    | Path after App\ root namespace.
    |
    */
    'component' => [
        'namespace' => 'View\Components',
        'parent' => 'app',
    ],

    /*
    |--------------------------------------------------------------------------
    | Controller Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Controllers will be generated.
    | Requires 'namespace' key.
    | Path after App\ root namespace.
    |
    */
    'controller' => [
        'namespace' => 'Http\Controllers',
        'parent' => 'app',
    ],

    /*
    |--------------------------------------------------------------------------
    | Event Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Events will be generated.
    | Requires 'namespace' key.
    | Path after App\ root namespace.
    |
    */
    'event' => [
        'namespace' => 'Events',
        'parent' => 'app',
    ],

    /*
    |--------------------------------------------------------------------------
    | Enum Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Enums will be generated.
    | Requires 'namespace' key.
    | Path after App\ root namespace.
    |
    */
    'enum' => [
        'namespace' => 'Enums',
        'parent' => 'app',
    ],

    /*
    |--------------------------------------------------------------------------
    | Exception Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Exceptions will be generated.
    | Requires 'namespace' key.
    | Path after App\ root namespace.
    |
    */
    'exception' => [
        'namespace' => 'Exceptions',
        'parent' => 'app',
    ],

    /*
    |--------------------------------------------------------------------------
    | Factory Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Factories will be generated.
    | Requires 'path' key.
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
    | Requires 'namespace' key.
    | Path after App\ root namespace.
    |
    */
    'job' => [
        'namespace' => 'Jobs',
        'parent' => 'app',
    ],

    /*
    |--------------------------------------------------------------------------
    | Listener Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Listeners will be generated.
    | Requires 'namespace' key.
    | Path after App\ root namespace.
    |
    */
    'listener' => [
        'namespace' => 'Listeners',
        'parent' => 'app',
    ],

    /*
    |--------------------------------------------------------------------------
    | Mail Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Mails will be generated.
    | Requires 'namespace' key.
    | Path after App\ root namespace.
    |
    */
    'mail' => [
        'namespace' => 'Mail',
        'parent' => 'app',
    ],

    /*
    |--------------------------------------------------------------------------
    | Middleware Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Middleware will be generated.
    | Requires 'namespace' key.
    | Path after App\ root namespace.
    |
    */
    'middleware' => [
        'namespace' => 'Http\Middleware',
        'parent' => 'app',
    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Migrations will be generated.
    | Requires 'path' key.
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
    | Requires 'namespace' key.
    | Path after App\ root namespace.
    |
    */
    'model' => [
        'namespace' => 'Data\Models',
        'parent' => 'app',
    ],

    /*
    |--------------------------------------------------------------------------
    | Notification Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Notifications will be generated.
    | Requires 'namespace' key.
    | Path after App\ root namespace.
    |
    */
    'notification' => [
        'namespace' => 'Notifications',
        'parent' => 'app',
    ],

    /*
    |--------------------------------------------------------------------------
    | Observer Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Observers will be generated.
    | Requires 'namespace' key.
    | Path after App\ root namespace.
    |
    */
    'observer' => [
        'namespace' => 'Data\Observers',
        'parent' => 'app',
    ],

    /*
    |--------------------------------------------------------------------------
    | Policy Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Policies will be generated.
    | Requires 'namespace' key.
    | Path after App\ root namespace.
    |
    */
    'policy' => [
        'namespace' => 'Policies',
        'parent' => 'app',
    ],

    /*
    |--------------------------------------------------------------------------
    | Provider Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Providers will be generated.
    | Requires 'namespace' key.
    | Path after App\ root namespace.
    |
    */
    'provider' => [
        'namespace' => 'Providers',
        'parent' => 'app',
    ],

    /*
    |--------------------------------------------------------------------------
    | Request Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Requests will be generated.
    | Requires 'namespace' key.
    | Path after App\ root namespace.
    |
    */
    'request' => [
        'namespace' => 'Http\Requests',
        'parent' => 'app',
    ],

    /*
    |--------------------------------------------------------------------------
    | Resource Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Resources will be generated.
    | Requires 'namespace' key.
    | Path after App\ root namespace.
    |
    */
    'resource' => [
        'namespace' => 'Http\Resources',
        'parent' => 'app',
    ],

    /*
    |--------------------------------------------------------------------------
    | Routes Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where routes may be loaded from.
    | Requires 'path' key.
    |
    */
    'routes' => [
        'path' => 'routes',
        'parent' => 'base',
    ],

    /*
    |--------------------------------------------------------------------------
    | Rule Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Rules will be generated.
    | Requires 'namespace' key.
    | Path after App\ root namespace.
    |
    */
    'rule' => [
        'namespace' => 'Rules',
        'parent' => 'app',
    ],

    /*
    |--------------------------------------------------------------------------
    | Scope Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Scopes will be generated.
    | Requires 'namespace' key.
    | Path after App\ root namespace.
    |
    */
    'scope' => [
        'namespace' => 'Scopes',
        'parent' => 'model',
    ],

    /*
    |--------------------------------------------------------------------------
    | Seeder Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Seeders will be generated.
    | Requires 'path' key.
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
    | Requires 'path' key.
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
    | Requires 'namespace' key.
    | Path after App\ root namespace.
    |
    */
    'value' => [
        'namespace' => 'Data\Values',
        'parent' => 'app',
    ],

    /*
    |--------------------------------------------------------------------------
    | View Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Views will be generated.
    | Requires 'path' key.
    |
    */
    'view' => [
        'path' => 'resources/views',
        'parent' => 'base',
    ],
];
