<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateFaqsTable extends Migration{
  public function up(){
    Schema::create('faqs', function (Blueprint $table) {
      $table->id();
      $table->integer('category_id');
      $table->string('title')->nullable();
      $table->text('details')->nullable();
      $table->string('meta_keywords')->nullable();
      $table->text('meta_descriptions')->nullable();
      $table->timestamps();
    });
  }
  public function down(){
    Schema::dropIfExists('faqs');
  }
}