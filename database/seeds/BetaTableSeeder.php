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
      $faker = Faker\Factory::create();

      $user = new App\User();
      $user->first_name = 'Admin';
      $user->last_name = 'Administrator';
      $user->email = 'admin@it.kmitl.ac.th';
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



       $courseList[1][] = [
         'code'  => '06016208',
         'name'  => 'MULTIMEDIA AND WEB TECHNOLOGY'
       ];
       $courseList[1][] = [
         'code'  => '06016207',
         'name'  => 'COMPUTER SYSTEMS ORGANIZATION AND OPERATING SYSTEMS'
       ];
       $courseList[1][] = [
         'code' => '06016206',
         'name'  => 'COMPUTER PROGRAMMING'
       ];
       $courseList[1][] = [
         'code' => '06016201',
         'name'  => 'MATHEMATICS FOR INFORMATION TECHNOLOGY'
       ];


       $courseList[2][] = [
         'code' => '06016217',
         'name' => 'DATABASE SYSTEM CONCEPTS'
      ];
      $courseList[2][] = [
         'code' => '06016216',
         'name' => 'Information Systems Analysis and Design'
       ];
       $courseList[2][] = [
         'code' => '06016215',
         'name' => 'WEB PROGRAMMING'
       ];
       $courseList[2][] = [
         'code' => '06016214',
         'name' => 'COMPUTER NETWORKING FOR ENTERPRISE AND ISP'
       ];
       $courseList[2][] = [
         'code' => '06016203',
         'name' => 'PROBABILITY AND STATISTICS'
       ];

       $courseList[3][] = [
         'code' => '06016233',
         'name' => 'NETWORK AND INFORMATION TECHNOLOGY INFRASTRUCTURE MANAGEMENT (แขนงเครือข่าย)'
       ];
       $courseList[3][] = [
         'code' => '06016234',
         'name' => 'WIRELESS NETWORK TECHNOLOGY (แขนงเครือข่าย)'
       ];
       $courseList[3][] = [
         'code' => '06016241',
         'name' => 'SUPPLY CHAIN MANAGEMENT AND LOGISTICS (แขนงอัจฉริยะ)'
       ];
       $courseList[3][] = [
         'code' => '06016242',
         'name' => 'KNOWLEDGE ENGINEERING AND MANAGEMENT (แขนงอัจฉริยะ)'
       ];
       $courseList[3][] = [
         'code' => '06016237',
         'name' => 'GAME DESIGN AND DEVELOPMENT (แขนงสื่อประสม)'
       ];
       $courseList[3][] = [
         'code' => '06016236',
         'name' => 'COMPUTER GRAPHICS AND ANIMATION (แขนงสื่อประสม)'
       ];
       $courseList[3][] = [
         'code' => '06016229',
         'name' => 'SOFTWARE VERIFICATION AND VALIDATION (แขนงซอฟต์แวร์)'
       ];
       $courseList[3][] = [
         'code' => '06016223',
         'name' => 'SEMINAR ON PROFESSIONAL COMMUNICATION SKILLS'
       ];
       $courseList[3][] = [
         'code' => '06016222',
         'name' => 'INFORMATION TECHNOLOGY PROJECT MANAGEMENT'
       ];
       $courseList[34][] = [
         'code' => '06016258',
         'name' => 'INTRODUCTION TO ENTERPRISE RESOURCE PLANNING'
       ];
       $courseList[34][] = [
         'code' => '06016278',
         'name' => 'SPECIAL TOPICS IN INFORMATION TECHNOLOGY 2 : Error Contro: Machine Learning'
       ];
       $courseList[34][] = [
         'code' => '06016277',
         'name' => 'SPECIAL TOPICS IN INFORMATION TECHNOLOGY 1'
       ];
       $courseList[34][] = [
         'code' => '06016274',
         'name' => 'SPECIAL TOPICS IN NETWORK AND SYSTEM TECHNOLOGY : Network Design'
       ];
       $courseList[34][] = [
         'code' => '06016248',
         'name' => 'DISTRIBUTED COMPUTING SYSTEMS'
       ];
       $courseList[34][] = [
         'code' => '06016256',
         'name' => 'IMAGE PROCESSING'
       ];
       $courseList[4][] = [
         'code' => '06016126',
         'name' => 'PROJECT 2'
       ];
       $courseList[4][] = [
         'code' => '06016281',
         'name' => 'COOPERATIVE EDUCATION'
       ];
       $courseList[4][] = [
         'code' => '06016225',
         'name' => 'PROJECT 2'
       ];
       $courseList[4][] = [
         'code' => '06016224',
         'name' => 'PROJECT 1'
       ];

     $class = ['1','2','3','34','4'];

     $t_id[1] = ['2','3','4'];
     $t_id[2] = ['5','6','7'];
     $t_id[3] = ['8','9','10'];
     $t_id[34] = ['11','12','13'];
     $t_id[4] = ['14','15','16'];

       foreach ($courseList as $courselist_key => $courseList_value) {
         $i = 10;
         foreach ($courseList_value as $course_key => $course_value) {
           $course = new App\Course();
           $course->code = $course_value['code'];
           $course->name = $course_value['name'];

           $course->class = $courselist_key ;
           $course->descript = $faker->text(50);
           $course->teach_id = serialize($t_id[$courselist_key ]);

           $memberArray = array();
           for ($x=$i; $x <$i+10 ; $x++) {
             $memberArray[$x-10] = (int)('560700'.$x);
           }
           $course->member = serialize($memberArray);
           $course->save();
           $i += 10;
         }
       }


    }
}
