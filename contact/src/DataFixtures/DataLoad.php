<?php

namespace App\DataFixtures;

use Faker\Factory as FakerGeneratorFactory;
use Faker\Generator as FakerGenerator;
use Nelmio\Alice\Faker\Provider\AliceProvider;
use Nelmio\Alice\Loader\NativeLoader;

class DataLoad extends NativeLoader
{
  protected function createFakerGenerator(): FakerGenerator
  {
    $generator = FakerGeneratorFactory::create('fr_FR');
    $generator->addProvider(new AliceProvider());
    $generator->seed($this->getSeed());
    return $generator;
  }
}