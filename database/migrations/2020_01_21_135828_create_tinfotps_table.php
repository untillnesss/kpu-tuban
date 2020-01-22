<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTinfotpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tinfotps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('tps')->index();
            $table->text('dpt');
            $table->text('kertas');
            $table->text('kotak');
            $table->text('bilik');
            $table->text('alascoblos');
            $table->text('tinta');
            $table->timestamps();

            $table->foreign('tps')->references('tps')->on('toperators')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tinfotps');
    }
}
