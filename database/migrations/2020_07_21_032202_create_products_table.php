<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->increments('id'); // primary key + auto increment
            $table->unsignedBigInteger('category_id'); // category boleh kosong // 11
            $table->string('name', 50 ); // tipe data varchar. auto 255
            $table->text('description'); // text
            $table->bigInteger('price'); // tipe data big integer // maksimal 20 digit
            $table->string('sku');
            $table->string('image');
            $table->string('status');
            $table->timestamps(); // genarete created_at dan updated_at dengan tipe data datetime
            $table->foreign('category_id')->references('id')->on('categories');
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
