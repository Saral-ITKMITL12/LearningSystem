<?php

use Illuminate\Database\Seeder;

class BetaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $user = new App\User();
      $user->first_name = 'Admin';
      $user->last_name = 'Administrator';
      $user->email = 'admin@kmitl.ac.th';
      $user->password = bcrypt('123456');
      $user->save();

      $admin = new App\Role();
      $admin->name         = 'admin';
      $admin->display_name = 'User Administrator'; // optional
      $admin->description  = 'User is allowed to manage and edit other users'; // optional
      $admin->save();


      $user->attachRole($admin);


      $teacher= new App\Role();
      $teacher->name         = 'teacher';
      $teacher->display_name = 'User Teacher'; // optional
      $teacher->description  = 'User is allowed to manage and edit crouse keyroom'; // optional
      $teacher->save();

      $std = new App\Role();
      $std->name         = 'student';
      $std->display_name = 'Student IT@KMITL'; // optional
      $std->description  = 'User is allowed to quiz'; // optional
      $std->save();


      $faker = Faker\Factory::create();


     for($i = 0; $i < 30; $i++) {
       $user = new App\User();
       $user->stud_id = '00000000';
       $user->first_name = $faker->firstName;
       $user->last_name = $faker->lastName;
       $user->email = $user->first_name.'@kmitl.ac.th';
       $user->password = bcrypt('123456');
       $user->save();

       $user->attachRole($teacher);
     }

     for($i = 0; $i < 60; $i++) {
       $user = new App\User();
       $user->stud_id = '560700'.($i+10);
       $user->first_name = $faker->firstName;
       $user->last_name = $faker->lastName;
       $user->email = $user->stud_id.'@kmitl.ac.th';
       $user->password = bcrypt('123456');
       $user->save();

       $user->attachRole($std);
     }

    }
}
