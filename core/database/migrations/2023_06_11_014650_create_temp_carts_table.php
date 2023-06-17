<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_temp_carts', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('item_id');
            $table->text('name')->nullable();
            $table->text('slug')->nullable();
            $table->string('sku')->nullable();
            $table->integer('brand_id')->nullable();
            $table->double('quantity')->default(0)->nullable();
            $table->double('price')->default(0)->nullable();
            $table->double('main_price')->default(0)->nullable();
            $table->string('photo')->nullable();
            $table->string('is_type')->nullable();
            $table->enum('item_type',['normal', 'digital'])->default('normal');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_temp_carts');
    }
}
