<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_table', function (Blueprint $table) {
            $table->integer('df', 3)->nullable()->default('NULL');
            $table->string('limapuluhpersen', 7)->nullable()->default('NULL');
            $table->string('duapuluhpersen', 7)->nullable()->default('NULL');
            $table->string('sepuluhpersen', 7)->nullable()->default('NULL');
            $table->string('limapersen', 8)->nullable()->default('NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_table');
    }
}
