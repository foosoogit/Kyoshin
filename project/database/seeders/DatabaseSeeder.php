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
				'subject'=> "JyukuName",
				'value1' => "教進セミナー",
				'setumei' => "塾名",
            ],
			[
				'subject'=> "DdisplayLineNumStudentsList",
				'value1' => "15",
				'setumei' => "生徒リストの表示行数",
            ],
			[
				'subject'=> "DdisplayLineNumDeliveryStudentsList",
				'value1' => "20",
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
				'subject'=> "sbjTest",
				'value1' => "テストメール --[name-jyuku]--",
				'setumei' => "テストメールの件名",
			],
        ];
		foreach($configrations as $configration) {
			$conf = new configration();
			$conf->subject=$configration['subject'];
            $conf->value1 = $configration['value1'];
			$conf->setumei = $configration['setumei'];
			$conf->save();
		}

		Student::factory()->count(50)->create();
        /*
		$init_students = [
			[
				'serial_student' => '2000009867183',
                'email' => 'awa@szemi-gp.com',
                'name_sei' => '内田',
                'name_mei'=> '奈那',
                'name_sei_kana'=> 'うちだ',
                'name_mei_kana'=> 'なな',
                'gender'=> '女',
                'protector'=> '内田',
                'pass_for_protector'=>'',
                'postal'=> '',
                'address_region'=> '',
                'address_locality'=> '',
                'address_banti'=> '',
                'phone'=> '',
                'grade'=> '小6',
                'course'=> '英会話',
            ],
			[
				'serial_student' => '2000009585742',
                'email' => 'prime@szemi-gp.com',
                'name_sei' => '川端',
                'name_mei'=> '直紘',
                'name_sei_kana'=> 'かわばた',
                'name_mei_kana'=> 'なおひろ',
                'gender'=> '男',
                'protector'=> '川端',
                'pass_for_protector'=>'',
                'postal'=> '',
                'address_region'=> '',
                'address_locality'=> '',
                'address_banti'=> '',
                'phone'=> '',
                'grade'=> '小6',
                'course'=> '英会話',
            ],
			[
				'serial_student' => '2000009585766',
                'email' => 'info@global-ep.net',
                'name_sei' => '神長倉',
                'name_mei'=> '怜',
                'name_sei_kana'=> 'かなくら',
                'name_mei_kana'=> 'れん',
                'gender'=> '女',
                'protector'=> '神長倉',
                'pass_for_protector'=>'',
                'postal'=> '',
                'address_region'=> '',
                'address_locality'=> '',
                'address_banti'=> '',
                'phone'=> '',
                'grade'=> '小6',
                'course'=> '英会話',
            ],
			[
				'serial_student' => '2000009585735',
                'email' => 'foosoo200@gmail.com',
                'name_sei' => '斎藤',
                'name_mei'=> '健倍',
                'name_sei_kana'=> 'さいとう',
                'name_mei_kana'=> 'けんばい',
                'gender'=> '男',
                'protector'=> '斎藤',
                'pass_for_protector'=>'',
                'postal'=> '',
                'address_region'=> '',
                'address_locality'=> '',
                'address_banti'=> '',
                'phone'=> '',
                'grade'=> '小6',
                'course'=> '英会話',
            ],
			[
				'serial_student' => '2000010016822',
                'email' => 'awa@szemi-gp.com',
                'name_sei' => '竹林',
                'name_mei'=> '莉乃',
                'name_sei_kana'=> 'たけばやし',
                'name_mei_kana'=> 'りの',
                'gender'=> '女',
                'protector'=> '竹林',
                'pass_for_protector'=>'',
                'postal'=> '',
                'address_region'=> '',
                'address_locality'=> '',
                'address_banti'=> '',
                'phone'=> '',
                'grade'=> '小6',
                'course'=> '英会話',
            ],
			[
				'serial_student' => '2000009585759',
                'email' => 'prime@szemi-gp.com',
                'name_sei' => '後藤',
                'name_mei'=> '杏寿',
                'name_sei_kana'=> 'ごとう',
                'name_mei_kana'=> 'あんじゅ',
                'gender'=> '女',
                'protector'=> '後藤',
                'pass_for_protector'=>'',
                'postal'=> '',
                'address_region'=> '',
                'address_locality'=> '',
                'address_banti'=> '',
                'phone'=> '',
                'grade'=> '小6',
                'course'=> '英会話',
            ],
			[
				'serial_student' => '2000009867084',
                'email' => 'info@global-ep.net',
                'name_sei' => '平尾',
                'name_mei'=> '麻畝',
                'name_sei_kana'=> 'ひらお',
                'name_mei_kana'=> 'まほ',
                'gender'=> '女',
                'protector'=> '平尾',
                'pass_for_protector'=>'',
                'postal'=> '',
                'address_region'=> '',
                'address_locality'=> '',
                'address_banti'=> '',
                'phone'=> '',
                'grade'=> '小6',
                'course'=> '英会話',
            ],
			[
				'serial_student' => '2000009867237',
                'email' => 'foosoo200@gmail.com',
                'name_sei' => '中尾',
                'name_mei'=> '真帆',
                'name_sei_kana'=> 'なかお',
                'name_mei_kana'=> 'まほ',
                'gender'=> '女',
                'protector'=> '中尾',
                'pass_for_protector'=>'',
                'postal'=> '',
                'address_region'=> '',
                'address_locality'=> '',
                'address_banti'=> '',
                'phone'=> '',
                'grade'=> '小6',
                'course'=> '英会話',
            ],
			[
				'serial_student' => '2000010016808',
                'email' => 'info@szemi-gp.com',
                'name_sei' => '樋口',
                'name_mei'=> '琴美',
                'name_sei_kana'=> 'ひぐち',
                'name_mei_kana'=> 'ことみ',
                'gender'=> '女',
                'protector'=> '樋口',
                'pass_for_protector'=>'',
                'postal'=> '',
                'address_region'=> '',
                'address_locality'=> '',
                'address_banti'=> '',
                'phone'=> '',
                'grade'=> '小6',
                'course'=> '英会話',
            ],
			[
				'serial_student' => '2000010016778',
                'email' => 'awa@szemi-gp.com',
                'name_sei' => '浜垣',
                'name_mei'=> '杏菜',
                'name_sei_kana'=> 'はまがき',
                'name_mei_kana'=> 'あん',
                'gender'=> '女',
                'protector'=> '浜垣',
                'pass_for_protector'=>'',
                'postal'=> '',
                'address_region'=> '',
                'address_locality'=> '',
                'address_banti'=> '',
                'phone'=> '',
                'grade'=> '小6',
                'course'=> '英会話',
            ],
        ];
        foreach($init_students as $init_student) {
			$student = new Student();
			$student->serial_student=$init_student['serial_student'];
            $student->email = $init_student['email'];
			$student->name_sei = $init_student['name_sei'];
			$student->name_mei = $init_student['name_mei'];
			$student->name_sei_kana = $init_student['name_sei_kana'];
			$student->name_mei_kana = $init_student['name_mei_kana'];
			$student->gender = $init_student['gender'];
			$student->protector = $init_student['protector'];
			$student->pass_for_protector = $init_student['pass_for_protector'];
			$student->postal = $init_student['postal'];
			$student->address_region = $init_student['address_region'];
			$student->address_locality = $init_student['address_locality'];
			$student->address_banti = $init_student['address_banti'];
			$student->phone = $init_student['phone'];
			$student->grade = $init_student['grade'];
			$student->course = $init_student['course'];
			$student->save();
		}
        */
        
		$init_users = [
			[
			'serial_user'=> "T_0000",
			//'email' => "kyoushin.fb@gmail.com",
			//'email' => "foosoo200@gmail.com",
			'email' => "awa@szemi-gp.com",
			'password' => "0000",
			'last_name_kanji' => "鈴木",
			'first_name_kanji' => "文彦",
			'last_name_jp_kana' => "スズキ",
			'first_name_jp_kana' => "フミヒコ",
			'rank' => "学習塾,英会話",
			'phone'=> "123-4567-8901",
			'gender' => "男",
			//'last_name_eng'=> "Suzuki",
			//'first_name_eng'=> "Fumihiko",
			//'phone'=> "000-0000-0000",
			//'address'=> "千葉県************",
            ],
			[
				'serial_user'=> "T_0001",
				'email' => "kyoushin.fb@gmail.com",
				//'email' => "foosoo200@gmail.com",
				'password' => "1111",
				'last_name_kanji' => "松浦",
				'first_name_kanji' => "重雅",
				'last_name_jp_kana' => "マツウラ",
				'first_name_jp_kana' => "シゲマサ",
				'rank' => "学習塾,英会話",
				'phone'=> "123-4567-8901",
				'gender' => "男",
				//'last_name_eng'=> "Suzuki",
				//'first_name_eng'=> "Fumihiko",
				//'phone'=> "000-0000-0000",
				//'address'=> "千葉県************",
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
