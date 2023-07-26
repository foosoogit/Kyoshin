<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //\App\Models\User::factory(10)->create();

        //\App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
		
		$init_students = [
			[
			'serial_student'=> "S_00000",
			'email' => "foosoo200@gmail.com",
			'name_sei' => "鈴木",
			'name_mei' => "文彦",
			'name_sei_kana' => "スズキ",
			'name_mei_kana' => "フミヒコ",
			'phone' => "0000-00-0000",
			'grade'=> "中学3年",
			//'first_name_eng'=> "Fumihiko",
			//'phone'=> "000-0000-0000",
			//'address'=> "千葉県************",
            ]
        ];
		foreach($init_students as $init_student) {
			$student = new student();
			$student->serial_student=$init_student['serial_student'];
            $student->email = $init_student['email'];
			$student->name_sei = $init_student['name_sei'];
			$student->name_mei = $init_student['name_mei'];
			$student->name_sei_kana = $init_student['name_sei_kana'];
			$student->name_mei_kana = $init_student['name_mei_kana'];
			$student->phone = $init_student['phone'];
			$student->grade = $init_student['grade'];
			//$user->rank = $init_student['last_name_eng'];
				
			//$user->phone = $init_student['phone'];
			//$user->address = $init_student['address'];
			
			$student->save();
		}
		/*
		$faker = \Faker\Factory::create('ja_JP');
		for ($i = 0; $i < 10; $i++) {
			Student::create([
				 'serial_student' => $faker->text(40),
				 'email' => $faker->text(),
				 'name_sei' => $user1->id
			]);
	   }
	   */
        /*
		$init_users = [
			[
			'serial_user'=> "T_0000",
			'email' => "foosoo200@gmail.com",
			'password' => "0000",
			'last_name_kanji' => "鈴木",
			'first_name_kanji' => "文彦",
			'last_name_jp_kana' => "スズキ",
			'first_name_jp_kana' => "フミヒコ",
			'rank' => "A",
			//'last_name_eng'=> "Suzuki",
			//'first_name_eng'=> "Fumihiko",
			//'phone'=> "000-0000-0000",
			//'address'=> "千葉県************",
            ]
        ];

        foreach($init_users as $init_user) {
			$user = new User();
			$user->serial_user=$init_user['serial_user'];
            $user->email = $init_user['email'];
            $user->password = Hash::make($init_user['password']);
			$user->name_sei = $init_user['last_name_kanji'];
			$user->name_mei = $init_user['first_name_kanji'];
			$user->name_sei_kana = $init_user['last_name_jp_kana'];
			$user->name_mei_kana = $init_user['first_name_jp_kana'];
			$user->rank = $init_user['rank'];
			//$user->rank = $init_user['last_name_eng'];
				
			//$user->phone = $init_user['phone'];
			//$user->address = $init_user['address'];
			
			$user->save();
		}
		*/
    }
}
