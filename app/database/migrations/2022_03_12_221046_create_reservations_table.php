<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('address');
            $table->string('image')->nullable();
            $table->string('name');
            $table->string('remarks')->nullable();
            $table->string('telnum');
            $table->string('backtime');
            $table->string('time');
            $table->string('category');
            $table->string('categoryname');
            $table->string('delivery')->nullable();
            $table->string('order');
            $table->string('sumprice');
            $table->string('price')->nullable();
            $table->string('task')->nullable();
            $table->integer('status')->default('1');
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
