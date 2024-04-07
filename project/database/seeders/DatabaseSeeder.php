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
        //$this->call(TruncateAllTables::class);
        //\App\Models\User::factory(10)->create();

        //\App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
		
		$configrations = [
			[
				'subject'=> "JyukuName",
				'value1' => "教進セミナー",
				'setumei' => "塾名",
            ],
			[
				'subject'=> "DdisplayLineNumStudentsList",
				'value1' => "12",
				'setumei' => "生徒リストの表示行数",
            ],
			[
				'subject'=> "DdisplayLineNumDeliveryStudentsList",
				'value1' => "200",
				'setumei' => "メール配信用生徒リストの表示行数",
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
			],
			[
				'subject'=> "Interval",
				'value1' => "5",
				'setumei' => "退出時間までの最短時間（分、以上）",
			],
			[
				'subject'=> "sbjIn",
				'value1' => "[name-student]様が入室されました。---[name-jyuku]---",
				'setumei' => "入出メッセージの件名",
			],
			[
				'subject'=> "MsgIn",
				'value1' => "[name-protector]様
				[name-student]さんが入室されました。
				入出時間：[time]",
				'setumei' => "入室時メッセージ",
			],
			[
				'subject'=> "sbjOut",
				'value1' => "[name-student]様が退出されました。---[name-jyuku]---",
				'setumei' => "退出メッセージの件名",
			],
			[
				'subject'=> "MsgOut",
				'value1' => "[name-protector]様
				[name-student]さんが退出されました。
				退室時間：[time]",
				'setumei' => "入室時メッセージ",
			],
			[
				'subject'=> "MsgTest",
				'value1' => "[name-protector]様
				このメールは送信テストです。受け取られましたら、そのまま返信ください。
				生徒お名前：[name-student]様
				受け取られる方のお名前：[name-protector]様
				送信時間：[time]",
				'setumei' => "送信テストメッセージ",
			],
			[
				'subject'=> "MsgFooter",
				'value1' => "教進セミナー",
				'setumei' => "送信メールフッター",
			],
			[
				'subject'=> "sbjTest",
				'value1' => "テストメール --[name-jyuku]--",
				'setumei' => "テストメールの件名",
			],
            [
				'subject'=> "Gender",
				'value1' => "男,女",
				'setumei' => "性別",
			],
        ];
		foreach($configrations as $configration) {
			$conf = new configration();
			$conf->subject=$configration['subject'];
            $conf->value1 = $configration['value1'];
			$conf->setumei = $configration['setumei'];
			$conf->save();
		}

        Student::factory()->count(10000)->create();
       
		$init_users = [
			[
			'serial_user'=> "T_0000",
			'email' => "awa@szemi-gp.com",
			'password' => "0000",
			'last_name_kanji' => "鈴木",
			'first_name_kanji' => "文彦",
			'last_name_jp_kana' => "スズキ",
			'first_name_jp_kana' => "フミヒコ",
			'rank' => "学習塾,英会話",
			'phone'=> "123-4567-8901",
			'gender' => "男",
            ],
			[
				'serial_user'=> "T_0001",
				'email' => "kyoushin.fb@gmail.com",
				'password' => "1111",
				'last_name_kanji' => "松浦",
				'first_name_kanji' => "重雅",
				'last_name_jp_kana' => "マツウラ",
				'first_name_jp_kana' => "シゲマサ",
				'rank' => "学習塾,英会話",
				'phone'=> "123-4567-8901",
				'gender' => "男",
			],
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
			$user->phone = $init_user['phone'];
			$user->save();
		}

    }
}
