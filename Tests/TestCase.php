<?php

namespace AizPackages\ColorCodeConverter\Tests;

use AizPackages\ColorCodeConverter\Providers\ColorCodeConverterProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
  public function setUp(): void
  {
    parent::setUp();
    // additional setup
  }

  protected function getPackageProviders($app)
  {
    return [
        ColorCodeConverterProvider::class,
    ];
  }

  protected function getEnvironmentSetUp($app)
  {
    // perform environment setup
  }
}