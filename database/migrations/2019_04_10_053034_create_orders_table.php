<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('refNo')->unique();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('product');
            $table->unsignedBigInteger('quantity');
            $table->enum('status', array('pending', 'confirmed', 'completed','cancelled'));
            $table->decimal("total", 10, 2);
            $table->timestamps();

            //set the foreign keys
            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete("set null")
            ->onUpdate("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
