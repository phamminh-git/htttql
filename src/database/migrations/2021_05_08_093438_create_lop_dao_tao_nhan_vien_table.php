<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLopDaoTaoNhanVienTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lop_dao_tao_nhan_vien', function (Blueprint $table) {
            $table->id();
            $table->integer('nhan_vien_id');
            $table->integer('lop_dao_tao_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lop_dao_tao_nhan_vien');
    }
}
