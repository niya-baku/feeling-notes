<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->bigIncrements('id'); //投稿ID

            $table->date('record'); //記録した日
            $table->time('wake_uptime'); //起床時間
            $table->time('bedtime'); //就寝時間
            $table->bigInteger('am_image'); //午前の調子
            $table->bigInteger('pm_image'); //午後の調子
            $table->bigInteger('night_image'); //夜の調子
            $table->text('body'); //自由欄
            $table->string('image')->nullable(); //画像
            $table->timestamps();

            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notes');
    }
}
