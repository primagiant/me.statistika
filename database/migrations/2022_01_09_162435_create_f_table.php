<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('f_table', function (Blueprint $table) {
            $table->integer('df1');
            $table->string('satu', 6)->nullable()->default('NULL');
            $table->string('dua', 6)->nullable()->default('NULL');
            $table->string('tiga', 6)->nullable()->default('NULL');
            $table->string('empat', 6)->nullable()->default('NULL');
            $table->string('lima', 6)->nullable()->default('NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('f_table');
    }
}
