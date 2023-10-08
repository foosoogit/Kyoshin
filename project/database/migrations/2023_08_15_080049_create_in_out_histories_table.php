<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('in_out_histories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->string('student_serial')->comment('生徒番号');
            $table->string('target_date',10)->comment('日付');
            $table->string('time_in',20)->comment('時間');
            $table->string('time_out',20)->nullable()->comment('時間');
            $table->string('student_name',50)->comment('生徒氏名');
            $table->string('student_name_kana',50)->comment('セイトシメイ');
            $table->string('to_mail_address',200)->comment('送り先メールアドレス');
            $table->string('from_mail_address',50)->comment('送り元メールアドレス');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('in_out_histories');
    }
};