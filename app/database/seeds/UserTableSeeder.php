<?php

class UserTableSeeder extends Seeder {
  
  public function run()
  {

    $user = new User;
    $user->firstname = 'Jeff';
    $user->lastname = 'Strongman';
    $user->email = 'admin@example.org';
    $user->password = 'test';
    $user->street = 'Somestreet';
    $user->number = '123';
    $user->zip = '1234';
    $user->city = 'The City';
    $user->country = 'Somewhere';
    $user->admin = 1;
    $user->save();
    
    $faker = Faker\Factory::create();
    
    foreach(range(1,200) as $index)
    {
      $firstname = $faker->firstName();
      $lastname = $faker->lastName();
      User::create([
        'firstname' => $firstname,
        'lastname' => $lastname,
        'email' => strtolower($firstname).'.'.strtolower($lastname).'@example.net',
        'password' => 'test',
        'street' => $faker->streetName(),
        'number' => $faker->buildingNumber(),
        'zip' => $faker->postcode(),
        'city' => $faker->city(),
        'country' => $faker->country(),
        'created_at' => $faker->dateTimeBetween('-6month', 'now')
      ]);
    }
    
  }
  
}