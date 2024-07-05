<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateSlidersTable extends Migration{
  public function up(){
    Schema::create('sliders', function (Blueprint $table) {
      $table->id();
      $table->string('photo')->nullable();
      $table->string('title')->nullable();
      $table->string('link')->nullable();
      $table->string('logo')->nullable();
      $table->string('details')->nullable();
      $table->char('content_check', 3)->default('false')->nullable();
      $table->text('content_info')->nullable();
      $table->timestamps();
    });
  }
  public function down(){
    Schema::dropIfExists('sliders');
  }
}