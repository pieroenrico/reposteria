<?php

namespace Pieroenrico\Reposteria\Commands;

use Illuminate\Console\Command;

class RepositoryGeneratorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tropa:repo {name : Class (singular) for example User}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a Repository in app/Http/Repo';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');

        $this->contract();
        $this->repository($name);
        $this->info('Repository ' . $name . 'Repository created successfully');
    }

    protected function contract()
    {
        $contractTemplate = $this->getStub('RepositoryContract');

        if(!file_exists($path = app_path('/Http/Repo')))
            mkdir($path, 0777, true);

        file_put_contents(app_path("/Http/Repo/RepositoryContract.php"), $contractTemplate);
    }

    protected function repository($name)
    {
        $repositoryTemplate = str_replace([
            '{{RepositoryName}}',
        ],[
            $name
        ], $this->getStub('Repository'));

        if(!file_exists($path = app_path('/Http/Repo')))
            mkdir($path, 0777, true);

        file_put_contents(app_path("/Http/Repo/{$name}Repository.php"), $repositoryTemplate);
    }

    protected function getStub($type)
    {
        return file_get_contents(__DIR__ ."/stubs/$type.stub");
    }
}
