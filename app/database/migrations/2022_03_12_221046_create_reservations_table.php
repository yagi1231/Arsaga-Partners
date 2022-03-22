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
            $table->string('address')->nullable();
            $table->string('image')->nullable();
            $table->string('name')->nullable();
            $table->string('remarks')->nullable();
            $table->string('telnum')->nullable();
            $table->string('backtime')->nullable();
            $table->string('time')->nullable();
            $table->string('category')->nullable();
            $table->string('categoryname')->nullable();
            $table->string('delivery')->nullable();
            $table->string('order')->nullable();
            $table->string('sumprice')->nullable();
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
