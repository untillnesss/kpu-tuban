<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTdatapemilihsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tdatapemilihs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('idOperator');
            $table->text('dpt');
            $table->text('dpph');
            $table->text('dptb');
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
        Schema::dropIfExists('tdatapemilihs');
    }
}
