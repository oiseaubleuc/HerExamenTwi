<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;
use Illuminate\Support\Facades\Blade;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, InteractsWithViews;

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
