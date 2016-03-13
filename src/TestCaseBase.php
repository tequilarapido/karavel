<?php

namespace Karavel;

use Illuminate\Foundation\Console\Kernel;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\TestCase as LaravelTestCase;

class TestCaseBase extends LaravelTestCase
{
    protected $baseUrl = 'http://localhost';

    public function createApplication()
    {
        $app = require __DIR__ . '/../../../../bootstrap/app.php';

        $this->setEnv();

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }

    protected function setEnv()
    {
        putenv('APP_ENV=testing');
        putenv('DB_CONNECTION=sqlite');
        putenv('DB_NAME=' . database_path('database.sqlite'));
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
}
