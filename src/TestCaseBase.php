<?php

namespace Karavel;

use Illuminate\Foundation\Console\Kernel;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\TestCase as LaravelTestCase;

class TestCaseBase extends LaravelTestCase
{
    protected $baseUrl = 'http://localhost';

    public $appPath;

    public function createApplication()
    {
        $this->appPath = realpath(__DIR__ . '/../../../../');

        $app = require $this->appPath . '/bootstrap/app.php';

        $this->setEnv();

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }

    protected function setEnv()
    {
        if (!file_exists($envFile = $this->appPath . '/.env.testing')) {
            echo PHP_EOL . '<!> ' . $envFile . '" file was not found.' . PHP_EOL;
            return;
        }

        $this->setFromEnvFile($envFile);
    }

    public function boot()
    {
        $this->setUp();

        return $this->app;
    }

    public function databaseMigrate()
    {
        $this->artisan('migrate');
    }

    public function databaseRollback()
    {
        $this->artisan('migrate:rollback');
    }

    public function databaseReset()
    {
        $this->databaseRollback();
        $this->databaseRollback();
    }

    protected function setFromEnvFile($file)
    {
        foreach (file($file) as $instruction) {
            $instruction = trim($instruction);
            if (!empty($instruction)) {
                putenv($instruction);
            }
        }
    }
}
