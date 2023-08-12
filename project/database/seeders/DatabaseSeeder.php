<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Student;
use App\Models\configration;
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
		
		$configrations = [
			[
				'subject'=> "DdisplayLineNumStudentsList",
				'value1' => "15",
				'setumei' => "生徒リストの表示行数",
            ],
			[
				'subject'=> "Grade",
				'value1' => "小1,小2,小3,小4,小5,小6,中1,中2,中3,高1,高2,高3",
				'setumei' => "学年",
			],
			[
				'subject'=> "Course",
				'value1' => "学習塾,英会話",
				'setumei' => "コース",
			]
        ];
		foreach($configrations as $configration) {
			$conf = new configration();
			$conf->subject=$configration['subject'];
            $conf->value1 = $configration['value1'];
			$conf->setumei = $configration['setumei'];
			$conf->save();
		}

		Student::factory()->count(50)->create();

		$init_users = [
			[
			'serial_user'=> "T_0000",
			'email' => "foosoo200@gmail.com",
			'password' => "0000",
			'last_name_kanji' => "松浦",
			'first_name_kanji' => "重雅",
			'last_name_jp_kana' => "マツウラ",
			'first_name_jp_kana' => "シゲマサ",
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
			$user->save();
		}

    }
}
