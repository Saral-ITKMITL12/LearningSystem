<?php

use Illuminate\Database\Seeder;


use App\Course;


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
       $user->email = 'teacher'.$i.'@it.kmitl.ac.th';
       $user->password = bcrypt('123456');
       $user->save();

       $user->attachRole($teacher);
     }

     for($i = 0; $i < 60; $i++) {
       $user = new App\User();
       $user->stud_id = '560700'.($i+10);
       $user->first_name = $faker->firstName;
       $user->last_name = $faker->lastName;
       $user->email = $user->stud_id.'@it.kmitl.ac.th';
       $user->password = bcrypt('123456');
       $user->save();

       $user->attachRole($std);
     }


     $class = ['1','2','3','34','4'];

     $t_id[0] = ['2','3','4'];
     $t_id[1] = ['5','6','7'];
     $t_id[2] = ['8','9','10'];
     $t_id[3] = ['11','12','13'];
     $t_id[4] = ['14','15','16'];

     foreach ($class as $key => $value) {
       for ($i=0; $i < 6 ; $i++) {

         $course = new Course();
         $course->code = $faker->randomNumber(8);
         $course->name = $faker->text(50);
         $course->class = $value;
         $course->descript = $faker->text(50);

         $course->teach_id = serialize($t_id[$key]);

         $memberArray = array();
         for ($x=10; $x <50 ; $x++) {
           $memberArray[$x-10] = (int)('560700'.$x);
         }
         $course->member = serialize($memberArray);
         $course->save();
       }
     }


    }
}
