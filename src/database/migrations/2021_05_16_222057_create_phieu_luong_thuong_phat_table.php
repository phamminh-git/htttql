<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhieuLuongThuongPhatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phieu_luong_thuong_phat', function (Blueprint $table) {
            $table->id();
            $table->integer('phieuluong_id')->nullable();
            $table->integer('thuongphat_id')->nullable();
            $table->float('muctien');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phieu_luong_thuong_phat');
    }
}
