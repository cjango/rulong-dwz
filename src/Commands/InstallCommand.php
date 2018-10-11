<?php

namespace RuLong\Panel\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{

    protected $signature = 'admin:install';

    protected $description = 'Init Admin';

    private $directory;

    public function handle()
    {
        $this->call('vendor:publish', [
            '--provider' => 'RuLong\Panel\ServiceProvider',
        ]);

        self::initDatabase();

        self::initModule();

        $this->info('Init admin success.');
    }

    private function initDatabase()
    {
        $this->call('migrate');
        $this->call('db:seed', ['--class' => AdminTablesSeeder::class]);
        $this->info('Database migrate success');
    }

    private function initModule()
    {
        $this->directory = config('rulong.directory');
        if (is_dir($this->directory)) {
            $this->warn("{$this->directory} directory already exists !");
        } else {
            $this->makeDir('/');
            $this->info('Admin directory was created: ' . str_replace(base_path(), '', $this->directory));
        }

        $this->createHomeController();

        $this->createDefaultView();

        $this->createRoutesFile();
    }

    private function createHomeController()
    {
        if (is_dir($this->directory . '/Controllers')) {
            $this->warn("Controllers directory already exists !");
        } else {
            $this->makeDir('Controllers');
            $this->info("Controllers directory was created.");
        }

        $homeController = $this->directory . '/Controllers/HomeController.php';

        if (file_exists($homeController)) {
            $this->warn("HomeController already exists !");
        } else {
            $contents = $this->getStub('HomeController');
            $this->laravel['files']->put(
                $homeController,
                str_replace('DummyNamespace', config('rulong.route.namespace'), $contents)
            );
            $this->info('HomeController file was created: ' . str_replace(base_path(), '', $homeController));
        }
    }

    private function createDefaultView()
    {
        if (is_dir($this->directory . '/Views/home')) {
            $this->warn("DefaultView directory already exists !");
        } else {
            $this->makeDir('Views/home');
            $this->info('DefaultView directory was created.');
        }

        $file = $this->directory . '/Views/home/dashboard.blade.php';

        if (file_exists($file)) {
            $this->warn("DefaultView file already exists !");
        } else {
            $contents = $this->getStub('dashboard');
            $this->laravel['files']->put($file, $contents);
            $this->info('DefaultView file was created.');
        }
    }

    private function createRoutesFile()
    {
        $file = $this->directory . '/routes.php';
        if (file_exists($file)) {
            $this->warn("Routes file already exists !");
        } else {
            $contents = $this->getStub('routes');
            $this->laravel['files']->put($file, $contents);
            $this->info('Routes file was created: ' . str_replace(base_path(), '', $file));
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
