<?php

class CategoryTableSeeder extends Seeder {
  
  public function run()
  {

    $faker = Faker\Factory::create();

    foreach(range(1,20) as $index)
    {
      Category::create([
        'name' => $faker->company()
      ]);
    }

  }
  
}