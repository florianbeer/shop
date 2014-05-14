<?php

class OrdersTableSeeder extends Seeder {
  
  public function run()
  {

    $faker = Faker\Factory::create();

    foreach(range(1,300) as $index)
    {
      
      $subtotal = null;
      $total = null;
      $items = [];
      
      foreach(range(1, $faker->randomNumber(1,4)) as $index2)
      {
        $product = Product::find($faker->randomNumber(1,1000));
        $quantity = $faker->randomNumber(1,6);
        array_push($items, [
            'id' => $product->id,
            'name' => $product->title,
            'price' => $product->price,
            'tax' => $product->tax,
            'quantity' => $quantity
          ]
        );
        $subtotal += $product->price * $quantity;
        $total += ($product->price + $product->price * $product->tax/100) * $quantity;
      }
      
      Order::create([
        'user_id' => $faker->randomNumber(2,201),
        'subtotal' => $subtotal,
        'total' => $total,
        'items' => json_encode($items),
        'processed' => $faker->randomNumber(0,1),
        'created_at' => $faker->dateTimeBetween('-6month', 'now')
      ]);
    }
    
  }
  
}