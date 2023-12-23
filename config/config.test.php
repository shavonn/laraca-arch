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
        'path' => 'test/database',
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
        'namespace' => 'Test\Data\Casts',
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
        'namespace' => 'Test\Broadcasting',
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
        'namespace' => 'Test\Console\Commands',
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
        'namespace' => 'Test\View\Components',
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
        'namespace' => 'Test\Http\Controllers',
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
        'namespace' => 'Test\Events',
    ],

    /*
    |--------------------------------------------------------------------------
    | Enum Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Enums will be generated.
    | Path from App\ root namespace.
    |
    */
    'enum' => [
        'namespace' => 'Test\Enums',
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
        'namespace' => 'Test\Exceptions',
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
        'namespace' => 'Test\Jobs',
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
        'namespace' => 'Test\Listeners',
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
        'namespace' => 'Test\Mail',
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
        'namespace' => 'Test\Http\Middleware',
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
        'namespace' => 'Test\Data\Models',
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
        'namespace' => 'Test\Notifications',
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
        'namespace' => 'Test\Data\Observers',
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
        'namespace' => 'Test\Policies',
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
        'namespace' => 'Test\Providers',
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
        'namespace' => 'Test\Http\Requests',
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
        'namespace' => 'Test\Http\Resources',
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
        'namespace' => 'Test\Rules',
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
        'namespace' => 'Test\Data\Models\Scopes',
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
        'path' => 'test/tests',
    ],

    /*
    |--------------------------------------------------------------------------
    | Value Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Values will be generated.
    | Path from App\ root namespace.
    |
    */
    'value' => [
        'namespace' => 'Test\Data\Models\Values',
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
        'path' => 'test/resources/views',
    ],
];
