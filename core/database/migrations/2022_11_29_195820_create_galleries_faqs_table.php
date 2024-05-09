<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateGalleriesFaqsTable extends Migration{
  public function up(){
    Schema::create('galleries_faqs', function (Blueprint $table) {
      $table->id();
      $table->integer('faq_id');
      $table->string('photo')->nullable();
      $table->timestamps();
    });
  }
  public function down(){
    Schema::dropIfExists('galleries_faqs');
  }
}