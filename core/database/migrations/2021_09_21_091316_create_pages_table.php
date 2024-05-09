<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreatePagesTable extends Migration{
  public function up(){
    Schema::create('pages', function (Blueprint $table) {
      $table->id();
      $table->string('title')->nullable();
      $table->string('slug')->nullable();
      $table->text('details')->nullable();
      $table->string('meta_keywords')->nullable();
      $table->text('meta_descriptions')->nullable();
      $table->tinyInteger('pos')->nullable();
      $table->timestamps();
    });
  }
  public function down(){
    Schema::dropIfExists('pages');
  }
}