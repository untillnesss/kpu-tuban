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
            $table->unsignedBigInteger('idOperator');
            $table->text('dpt');
            $table->text('kertas');
            $table->text('bilik');
            $table->text('alas');
            $table->text('tinta');
            $table->timestamps();

            $table->foreign('idOperator')->references('id')->on('toperators')->onDelete('cascade');
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
