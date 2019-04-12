<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text("description");
            $table->decimal('price', 10, 2);
            $table->string("img_path");
            $table->enum('status', array('active', 'inactive', 'sold'));
            $table->unsignedBigInteger('order_id')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->timestamps();
            //relate categories and items
            $table->foreign('category_id')
            ->references('id')
            ->on('categories')
            ->onDelete("restrict")
            ->onUpdate("cascade");

            $table->foreign('order_id')
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
        Schema::dropIfExists('products');
    }
}
