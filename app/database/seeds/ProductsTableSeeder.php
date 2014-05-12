<?php

class ProductsTableSeeder extends Seeder {
  
  public function run()
  {

    $faker = Faker\Factory::create();

    foreach(range(1,1000) as $index)
    {
      Product::create([
        'category_id' => $faker->randomNumber(1,20),
        'title' => $faker->company(),
        'description' => $faker->realText($maxNbChars = 400, $indexSize = 2),
        'price' => $faker->randomFloat($nbMaxDecimals = 2, $min = 1, $max = 50),
        'tax' => 20,
        'image' => $faker->imageUrl($width = 480, $height = 640, 'food').$faker->word(),
      ]);
    }
    
    foreach(range(1,4) as $index)
    {
      $product = Product::find($faker->randomNumber(1,1000));
      $product->featured = 1;
      $product->save();
    }
    
  }
  
}