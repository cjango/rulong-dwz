<?php

namespace RuLong\Panel\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class MakeCommand extends Command
{

    protected $signature = 'admin:make {controller}';

    protected $description = 'Make Admin Controller and Model';

    private $directory;

    public function handle()
    {
        $this->directory = config('rulong.directory');

        $this->makeControllerDirectory();

        $controllerName = $this->argument('controller');

        $this->makeControllerFile(Str::studly($controllerName));

        $this->info('Init admin success.');
    }

    private function makeControllerDirectory()
    {
        if (is_dir($this->directory . '/Controllers')) {
            $this->warn("Controllers directory already exists !");
        } else {
            $this->makeDir('Controllers');
            $this->info("Controllers directory was created.");
        }
    }

    public function makeControllerFile($controllerName)
    {
        $file = $this->directory . '/Controllers/' . $controllerName . 'Controller.php';
        if (file_exists($file)) {
            $this->warn($controllerName . "Controller file already exists !");
        } else {
            $contents = $this->getStub('controller');
            $this->laravel['files']->put(
                $file,
                str_replace(['DummyNamespace', 'ControllerName'], [config('rulong.route.namespace'), $controllerName . 'Controller'], $contents)
            );
            $this->info('Controller file was created: ' . str_replace(base_path(), '', $file));
        }
    }

    private function getStub($name)
    {
        return $this->laravel['files']->get(__DIR__ . "/stubs/$name.stub");
    }

    private function makeDir($path = '')
    {
        $this->laravel['files']->makeDirectory("{$this->directory}/$path", 0755, true, true);
    }
}
