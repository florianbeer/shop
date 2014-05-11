<?php

class UserTableSeeder extends Seeder {
  
  public function run() {

    $user = new User;
    $user->firstname = 'Florian';
    $user->lastname = 'Beer';
    $user->email = 'fb@42dev.eu';
    $user->password = Hash::make('flo');
    $user->street = 'Millergasse';
    $user->number = '40/14';
    $user->zip = '1060';
    $user->city = 'Wien';
    $user->country = 'Österreich';
    $user->admin = 1;
    $user->save();
    
    $user = new User;
    $user->firstname = 'Stefan';
    $user->lastname = 'Zehetbauer';
    $user->email = 'st.zehetbauer@live.com';
    $user->password = Hash::make('test');
    $user->street = 'Hauptstraße';
    $user->number = '3';
    $user->zip = '7081';
    $user->city = 'Schützen am Gebirge';
    $user->country = 'Österreich';
    $user->admin = 1;
    $user->save();
    
    $faker = Faker\Factory::create();
    
    foreach(range(1,200) as $index) {
      $firstname = $faker->firstName();
      $lastname = $faker->lastName();
      User::create([
        'firstname' => $firstname,
        'lastname' => $lastname,
        'email' => strtolower($firstname).'.'.strtolower($lastname).'@example.net',
        'password' => Hash::make('test'),
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