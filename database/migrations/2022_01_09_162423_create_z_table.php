<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('z_table', function (Blueprint $table) {
            $table->decimal('z', 10, 1);
            $table->decimal('nol', 10, 4);
            $table->decimal('satu', 10, 4);
            $table->decimal('dua', 10, 4);
            $table->decimal('tiga', 10, 4);
            $table->decimal('empat', 10, 4);
            $table->decimal('lima', 10, 4);
            $table->decimal('enam', 10, 4);
            $table->decimal('tujuh', 10, 4);
            $table->decimal('delapan', 10, 4);
            $table->decimal('sembilan', 10, 4);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('z_table');
    }
}
