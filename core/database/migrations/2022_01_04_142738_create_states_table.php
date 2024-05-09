<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateStatesTable extends Migration{
  public function up(){
    Schema::create('states', function (Blueprint $table) {
      $table->id();
      $table->string('name')->nullable();
      $table->double('price')->default(0)->nullable();
      $table->tinyInteger('status')->default(1)->nullable();       
    });
  }
  public function down(){
    Schema::dropIfExists('states');
  }
}