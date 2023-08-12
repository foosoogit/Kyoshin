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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->string('serial_student')->unique()->comment('生徒番号');
            $table->string('email')->unique()->comment('メールアドレス（複数の場合はカンマでつなげる）');
            $table->string('name_sei',100)->comment('姓');
			$table->string('name_mei',100)->comment('名');
			$table->string('name_sei_kana',100)->comment('セイ');
			$table->string('name_mei_kana',100)->comment('メイ');
            $table->string('protector',100)->comment('保護者');
			$table->string('gender',10)->nullable();
			$table->string('birth_year',10)->nullable();
			$table->string('birth_month',10)->nullable();
			$table->string('birth_day',10)->nullable();
			$table->string('postal',15)->nullable();
			$table->string('address_region')->nullable();
			$table->string('address_locality')->nullable();
			$table->string('address_banti')->nullable();
            $table->string('phone',15)->nullable();
            $table->string('grade',10)->comment('学年');
            $table->string('course',50)->nullable()->comment('受講コース');            
            $table->text('note')->nullable()->comment('備考');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
};
