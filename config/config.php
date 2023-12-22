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
    | Path from project root.
    |
    */
    'database' => [
        'path' => 'database',
    ],

    /*
    |--------------------------------------------------------------------------
    | Cast Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Casts will be generated.
    | Path from App\ root namespace.
    |
    */
    'cast' => [
        'namespace' => 'Data\Casts',
    ],

    /*
    |--------------------------------------------------------------------------
    | Channel Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Channels will be generated.
    | Path from App\ root namespace.
    |
    */
    'channel' => [
        'namespace' => 'Broadcasting',
    ],

    /*
    |--------------------------------------------------------------------------
    | Command Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Commands will be generated.
    | Path from App\ root namespace.
    |
    */
    'command' => [
        'namespace' => 'Console\Commands',
    ],

    /*
    |--------------------------------------------------------------------------
    | Component Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Components will be generated.
    | Path from App\ root namespace.
    |
    */
    'component' => [
        'namespace' => 'View\Components',
    ],

    /*
    |--------------------------------------------------------------------------
    | Controller Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Controllers will be generated.
    | Path from App\ root namespace.
    |
    */
    'controller' => [
        'namespace' => 'Http\Controllers',
    ],

    /*
    |--------------------------------------------------------------------------
    | Enum Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Enum will be generated.
    | Path from App\ root namespace.
    |
    */
    'enum' => [
        'namespace' => 'Enums',
    ],

    /*
    |--------------------------------------------------------------------------
    | Event Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Events will be generated.
    | Path from App\ root namespace.
    |
    */
    'event' => [
        'namespace' => 'Events',
    ],

    /*
    |--------------------------------------------------------------------------
    | Exception Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Exceptions will be generated.
    | Path from App\ root namespace.
    |
    */
    'exception' => [
        'namespace' => 'Exceptions',
    ],

    /*
    |--------------------------------------------------------------------------
    | Factory Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Factories will be generated.
    | Path from database root.
    |
    */
    'factory' => [
        'path' => 'factories',
    ],

    /*
    |--------------------------------------------------------------------------
    | Job Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Jobs will be generated.
    | Path from App\ root namespace.
    |
    */
    'job' => [
        'namespace' => 'Jobs',
    ],

    /*
    |--------------------------------------------------------------------------
    | Listener Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Listeners will be generated.
    | Path from App\ root namespace.
    |
    */
    'listener' => [
        'namespace' => 'Listeners',
    ],

    /*
    |--------------------------------------------------------------------------
    | Mail Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Mails will be generated.
    | Path from App\ root namespace.
    |
    */
    'mail' => [
        'namespace' => 'Mail',
    ],

    /*
    |--------------------------------------------------------------------------
    | Middleware Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Middleware will be generated.
    | Path from App\ root namespace.
    |
    */
    'middleware' => [
        'namespace' => 'Http\Middleware',
    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Migrations will be generated.
    | Path from database root.
    |
    */
    'migration' => [
        'path' => 'migrations',
    ],

    /*
    |--------------------------------------------------------------------------
    | Model Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Models will be generated.
    | Path from App\ root namespace.
    |
    */
    'model' => [
        'namespace' => 'Data\Models',
    ],

    /*
    |--------------------------------------------------------------------------
    | Notification Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Notifications will be generated.
    | Path from App\ root namespace.
    |
    */
    'notification' => [
        'namespace' => 'Notifications',
    ],

    /*
    |--------------------------------------------------------------------------
    | Observer Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Observers will be generated.
    | Path from App\ root namespace.
    |
    */
    'observer' => [
        'namespace' => 'Data\Observers',
    ],

    /*
    |--------------------------------------------------------------------------
    | Policy Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Policies will be generated.
    | Path from App\ root namespace.
    |
    */
    'policy' => [
        'namespace' => 'Policies',
    ],

    /*
    |--------------------------------------------------------------------------
    | Provider Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Providers will be generated.
    | Path from App\ root namespace.
    |
    */
    'provider' => [
        'namespace' => 'Providers',
    ],

    /*
    |--------------------------------------------------------------------------
    | Request Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Requests will be generated.
    | Path from App\ root namespace.
    |
    */
    'request' => [
        'namespace' => 'Http\Requests',
    ],

    /*
    |--------------------------------------------------------------------------
    | Resource Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Resources will be generated.
    | Path from App\ root namespace.
    |
    */
    'resource' => [
        'namespace' => 'Http\Resources',
    ],

    /*
    |--------------------------------------------------------------------------
    | Rule Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Rules will be generated.
    | Path from App\ root namespace.
    |
    */
    'rule' => [
        'namespace' => 'Rules',
    ],

    /*
    |--------------------------------------------------------------------------
    | Scope Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Scopes will be generated.
    | Path from App\ root namespace.
    |
    */
    'scope' => [
        'namespace' => 'Data\Models\Scopes',
    ],

    /*
    |--------------------------------------------------------------------------
    | Seeder Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Seeders will be generated.
    | Path from database root.
    |
    */
    'seeder' => [
        'path' => 'seeders',
    ],

    /*
    |--------------------------------------------------------------------------
    | Test Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Tests will be generated.
    | Path from project root.
    |
    */
    'test' => [
        'path' => 'tests',
    ],

    /*
    |--------------------------------------------------------------------------
    | View Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Views will be generated.
    | Path from project root.
    |
    */
    'view' => [
        'path' => 'resources/views',
    ],
];
