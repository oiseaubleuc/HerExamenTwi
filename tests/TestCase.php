<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\Blade;

abstract class TestCase extends BaseTestCase
{
    use InteractsWithViews;

    /**
     * Bootstrap the application for testing (i.p.v. de CreatesApplication trait)
     */
    public function createApplication()
    {
        $app = require __DIR__ . '/../bootstrap/app.php';
        $app->make(Kernel::class)->bootstrap();
        return $app;
    }

    protected function setUp(): void
    {
        parent::setUp();

        if (method_exists($this, 'withoutVite')) {
            $this->withoutVite();
        } else {
            Blade::directive('vite', fn () => '');
        }
    }
}
