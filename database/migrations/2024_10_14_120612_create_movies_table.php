<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // ชื่อภาพยนตร์
            $table->year('release_year'); // ปีที่ออกฉาย
            $table->string('genre'); // ประเภทของภาพยนตร์
            $table->text('description')->nullable(); // คำอธิบายของภาพยนตร์ (ไม่บังคับ)
            $table->timestamps(); // คอลัมน์ created_at และ updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movies');
    }
};

