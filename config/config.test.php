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
        'namespace' => 'Test\\Database',
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
        'path' => 'Test/Data/Casts',
        'namespace' => 'Test\\Data\\Casts',
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
        'path' => 'Test/Broadcasting',
        'namespace' => 'Test\\Broadcasting',
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
        'path' => 'Test/Console/Commands',
        'namespace' => 'Test\\Console\\Commands',
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
        'path' => 'Test/View/Components',
        'namespace' => 'Test\\View\\Components',
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
        'path' => 'Test/Http/Controllers',
        'namespace' => 'Test\\Http\\Controllers',
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
        'path' => 'Test/Events',
        'namespace' => 'Test\\Events',
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
        'path' => 'Test/Exceptions',
        'namespace' => 'Test\\Exceptions',
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
        'namespace' => 'Test\\Database\\Factories',
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
        'path' => 'Test/Jobs',
        'namespace' => 'Test\\Jobs',
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
        'path' => 'Test/Listeners',
        'namespace' => 'Test\\Listeners',
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
        'path' => 'Test/Mail',
        'namespace' => 'Test\\Mail',
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
        'path' => 'Test/Http/Middleware',
        'namespace' => 'Test\\Http\\Middleware',
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
        'path' => 'Test/Data/Models',
        'namespace' => 'Test\\Data\\Models',
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
        'path' => 'Test/Notifications',
        'namespace' => 'Test\\Notifications',
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
        'path' => 'Test/Data/Observers',
        'namespace' => 'Test\\Data\\Observers',
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
        'path' => 'Test/Policies',
        'namespace' => 'Test\\Policies',
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
        'path' => 'Test/Providers',
        'namespace' => 'Test\\Providers',
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
        'path' => 'Test/Http/Requests',
        'namespace' => 'Test\\Http\\Requests',
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
        'path' => 'Test/Http/Resources',
        'namespace' => 'Test\\Http\\Resources',
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
        'path' => 'Test/Rules',
        'namespace' => 'Test\\Rules',
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
        'path' => 'Test/Data/Models/Scopes',
        'namespace' => 'Test\\Data\\Models\\Scopes',
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
        'namespace' => 'Test\\Database\\Seeders',
    ],

    /*
    |--------------------------------------------------------------------------
    | Test Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Tests will be generated.
    |
    */
    'test' => [
        'path' => 'test/tests',
        'namespace' => 'Test\\Tests',
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
        'path' => 'test/resources/views',
    ],
];
