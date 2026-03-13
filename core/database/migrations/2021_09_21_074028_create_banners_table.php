<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateBannersTable extends Migration{
  public function up(){
    Schema::create('banners', function (Blueprint $table) {
      $table->id();
      $table->string('title')->nullable();
      $table->string('subtitle')->nullable();
      $table->string('url')->nullable();
      $table->string('image')->nullable();
      $table->string('type')->nullable();
      $table->tinyInteger('status')->default()->nullable();
      $table->timestamps();
    });
  }
  public function down(){
    Schema::dropIfExists('banners');
  }
}