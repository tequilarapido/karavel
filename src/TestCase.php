<?php

namespace Karavel;

use Illuminate\Foundation\Console\Kernel;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\TestCase as LaravelTestCase;

class TestCase extends LaravelTestCase
{

    use DatabaseMigrations;

    protected $baseUrl = 'http://localhost';

    public function createApplication()
    {

        $this->setEnv();

        $app = require __DIR__ . '/../bootstrap/app.php';

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

    public function destroy()
    {
        $this->artisan('migrate:rollback');
    }
}
