<?php

namespace AizPackages\ColorCodeConverter\Tests;

use AizPackages\ColorCodeConverter\Providers\ColorCodeConverterProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
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