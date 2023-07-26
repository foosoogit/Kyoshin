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
