<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateBcategoriesTable extends Migration{
  public function up(){
    Schema::create('bcategories', function (Blueprint $table) {
      $table->id();
      $table->string('name')->nullable();
      $table->string('slug')->nullable();
      $table->tinyInteger('status')->default()->nullable();
      $table->timestamps();
    });
  }
  public function down(){
    Schema::dropIfExists('bcategories');
  }
}