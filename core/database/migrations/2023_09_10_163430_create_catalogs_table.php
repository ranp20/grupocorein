<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatalogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_catalogs', function (Blueprint $table) {
            $table->id();
            $table->text('name')->nullable();
            $table->string('photo')->nullable();
            $table->string('adj_doc')->nullable();
            $table->tinyInteger('status')->default()->nullable();
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
        Schema::dropIfExists('tbl_catalogs');
    }
}