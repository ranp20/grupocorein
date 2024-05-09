<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateBannersPagesTable extends Migration{
  public function up(){
    Schema::create('tbl_banners_pages', function (Blueprint $table) {
      $table->id();
      $table->text('name')->nullable();
      $table->integer('sections_id')->nullable();
      $table->string('photo')->nullable();
      $table->tinyInteger('status')->default()->nullable();
      $table->timestamps();
    });
  }
  public function down(){
    Schema::dropIfExists('tbl_banners_pages');
  }
}