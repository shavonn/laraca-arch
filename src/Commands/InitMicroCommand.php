<?php

namespace HandsomeBrown\Laraca\Commands;

use HandsomeBrown\Laraca\Commands\Traits\LaracaCommand;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Config;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputArgument;

#[AsCommand(name: 'init:micro')]
class InitMicroCommand extends Command
{
    use LaracaCommand;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'init:micro';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new microservice';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Microservice';

    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * Create a new controller creator command instance.
     *
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }

    /**
     * Execute the console command.
     *
     * @return bool|null
     */
    public function handle()
    {
        if ($this->input->hasArgument('domain')) {
            $domain = ucfirst($this->input->getArgument('domain'));
            if (self::domainsEnabled() && $domain) {
                $servicePath = self::assembleFullPath('microservice', $domain);
            }
        } else {
            $servicePath = $this->assembleFullPath('microservice');
        }

        $name = ucfirst($this->input->getArgument('name'));
        $servicePath = "$servicePath/$name";

        $contains = Config::get('laraca.structure.microservice.elements');

        foreach ($contains as $element) {
            switch ($element) {
                case 'routes':
                    $path = 'routes';
                    break;

                default:
                    $path = $this->assembleRelativePath($element, null, false);
                    break;
            }

            $path = "$servicePath/$path";

            if (! $this->files->isDirectory($path)) {
                $this->files->makeDirectory($path, 0777, true, true);
            }
        }

        $this->components->info('Service created successfully.');

        return Command::SUCCESS;
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the '.strtolower($this->type)],
        ];
    }
}
