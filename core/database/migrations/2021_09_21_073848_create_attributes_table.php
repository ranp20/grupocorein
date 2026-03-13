<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateAttributesTable extends Migration{
  public function up(){
    Schema::create('attributes', function (Blueprint $table) {
      $table->id();
      $table->integer('item_id')->nullable();
      $table->string('name')->nullable();
      $table->string('keyword')->nullable();
      $table->timestamps();
    });
  }
  public function down(){
    Schema::dropIfExists('attributes');
  }
}