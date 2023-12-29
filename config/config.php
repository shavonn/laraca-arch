<?php

/*
 * Laraca config
 */
return [
    /*
    |--------------------------------------------------------------------------
    | Directory structure config
    |--------------------------------------------------------------------------
    */
    'struct' => [
        /*
        |--------------------------------------------------------------------------
        | Cast Path
        |--------------------------------------------------------------------------
        | make:cast
        */
        'cast' => [
            'path' => 'Data/Casts',
            'parent' => 'app',
        ],

        /*
        |--------------------------------------------------------------------------
        | Channel Path
        |--------------------------------------------------------------------------
        | make:channel
        */
        'channel' => [
            'path' => 'Broadcasting',
            'parent' => 'app',
        ],

        /*
        |--------------------------------------------------------------------------
        | Command Path
        |--------------------------------------------------------------------------
        | make:command
        */
        'command' => [
            'path' => 'Console/Commands',
            'parent' => 'app',
        ],

        /*
        |--------------------------------------------------------------------------
        | Component Path
        |--------------------------------------------------------------------------
        | This value is the path where Components will be generated.
        */
        'component' => [
            'path' => 'View/Components',
            'parent' => 'app',
        ],

        /*
        |--------------------------------------------------------------------------
        | Controller Path
        |--------------------------------------------------------------------------
        | make:controller
        */
        'controller' => [
            'path' => 'Http/Controllers',
            'parent' => 'app',
        ],

        /*
        |--------------------------------------------------------------------------
        | Database Path
        |--------------------------------------------------------------------------
        | Parent dir
        */
        'database' => [
            'path' => 'database',
            'parent' => 'base',
        ],

        /*
        |--------------------------------------------------------------------------
        | Domains
        |--------------------------------------------------------------------------
        | Enables optional domain argument in make commands
        */
        'domain' => [
            'enabled' => true,
            'path' => 'Domains', // dir name or null
            'parent' => 'app',
        ],

        /*
        |--------------------------------------------------------------------------
        | Enum Path
        |--------------------------------------------------------------------------
        | make:enum
        */
        'enum' => [
            'path' => 'Enums',
            'parent' => 'app',
        ],

        /*
        |--------------------------------------------------------------------------
        | Event Path
        |--------------------------------------------------------------------------
        | make:event
        */
        'event' => [
            'path' => 'Events',
            'parent' => 'app',
        ],

        /*
        |--------------------------------------------------------------------------
        | Exception Path
        |--------------------------------------------------------------------------
        | make:exception
        */
        'exception' => [
            'path' => 'Exceptions',
            'parent' => 'app',
        ],

        /*
        |--------------------------------------------------------------------------
        | Factory Path
        |--------------------------------------------------------------------------
        | make:factory
        */
        'factory' => [
            'path' => 'factories',
            'parent' => 'database',
        ],

        /*
        |--------------------------------------------------------------------------
        | Job Path
        |--------------------------------------------------------------------------
        | make:job
        */
        'job' => [
            'path' => 'Jobs',
            'parent' => 'app',
        ],

        /*
        |--------------------------------------------------------------------------
        | Listener Path
        |--------------------------------------------------------------------------
        | make:listener
        */
        'listener' => [
            'path' => 'Listeners',
            'parent' => 'app',
        ],

        /*
        |--------------------------------------------------------------------------
        | Mail Path
        |--------------------------------------------------------------------------
        | make:mail
        */
        'mail' => [
            'path' => 'Mail',
            'parent' => 'app',
        ],

        /*
        |--------------------------------------------------------------------------
        | Microservice Path
        |--------------------------------------------------------------------------
        | make:micro
        */
        'microservice' => [
            'path' => 'Microservices',
            'parent' => 'app',
            'elements' => [
                'command',
                'controller',
                'job',
                'middleware',
                'provider',
                'route',
                'test',
                'view',
            ],
        ],

        /*
        |--------------------------------------------------------------------------
        | Middleware Path
        |--------------------------------------------------------------------------
        | make:middleware
        */
        'middleware' => [
            'path' => 'Http/Middleware',
            'parent' => 'app',
        ],

        /*
        |--------------------------------------------------------------------------
        | Migration Path
        |--------------------------------------------------------------------------
        | make:migration
        */
        'migration' => [
            'path' => 'migrations',
            'parent' => 'database',
        ],

        /*
        |--------------------------------------------------------------------------
        | Model Path
        |--------------------------------------------------------------------------
        | make:model
        */
        'model' => [
            'path' => 'Data/Models',
            'parent' => 'app',
        ],

        /*
        |--------------------------------------------------------------------------
        | Notification Path
        |--------------------------------------------------------------------------
        | make:notification
        */
        'notification' => [
            'path' => 'Notifications',
            'parent' => 'app',
        ],

        /*
        |--------------------------------------------------------------------------
        | Observer Path
        |--------------------------------------------------------------------------
        | make:observer
        */
        'observer' => [
            'path' => 'Data/Observers',
            'parent' => 'app',
        ],

        /*
        |--------------------------------------------------------------------------
        | Policy Path
        |--------------------------------------------------------------------------
        | make:policy
        */
        'policy' => [
            'path' => 'Policies',
            'parent' => 'app',
        ],

        /*
        |--------------------------------------------------------------------------
        | Provider Path
        |--------------------------------------------------------------------------
        | make:provider
        */
        'provider' => [
            'path' => 'Providers',
            'parent' => 'app',
        ],

        /*
        |--------------------------------------------------------------------------
        | Request Path
        |--------------------------------------------------------------------------
        | make:request
        */
        'request' => [
            'path' => 'Http/Requests',
            'parent' => 'app',
        ],

        /*
        |--------------------------------------------------------------------------
        | Resource Path
        |--------------------------------------------------------------------------
        | make:resource
        */
        'resource' => [
            'path' => 'Http/Resources',
            'parent' => 'app',
        ],

        /*
        |--------------------------------------------------------------------------
        | Rule Path
        |--------------------------------------------------------------------------
        | make:rule
        */
        'rule' => [
            'path' => 'Rules',
            'parent' => 'app',
        ],

        /*
        |--------------------------------------------------------------------------
        | Service Path
        |--------------------------------------------------------------------------
        | make:service
        */
        'service' => [
            'path' => 'Services',
            'parent' => 'app',
        ],

        /*
        |--------------------------------------------------------------------------
        | Scope Path
        |--------------------------------------------------------------------------
        | make:scope
        */
        'scope' => [
            'path' => 'Scopes',
            'parent' => 'model',
        ],

        /*
        |--------------------------------------------------------------------------
        | Seeder Path
        |--------------------------------------------------------------------------
        | make:seed
        */
        'seeder' => [
            'path' => 'seeders',
            'parent' => 'database',
        ],

        /*
        |--------------------------------------------------------------------------
        | Test Path
        |--------------------------------------------------------------------------
        | make:test
        */
        'test' => [
            'path' => 'tests',
            'parent' => 'base',
        ],

        /*
        |--------------------------------------------------------------------------
        | Value Path
        |--------------------------------------------------------------------------
        | make:value
        */
        'value' => [
            'path' => 'Data/Values',
            'parent' => 'app',
        ],

        /*
        |--------------------------------------------------------------------------
        | View Path
        |--------------------------------------------------------------------------
        | make:view
        */
        'view' => [
            'path' => 'resources/views',
            'parent' => 'base',
        ],
    ],
];
