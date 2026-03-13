<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateSitemapsTable extends Migration{
  public function up(){
    Schema::create('sitemaps', function (Blueprint $table) {
      $table->id();
      $table->text('sitemap_lat')->nullable();
      $table->text('sitemap_lng')->nullable();
      $table->string('sitemap_name', 255)->nullable();
      $table->char('sitemap_status', 3)->nullable();
      $table->string('sitemap_url', 255)->nullable();
      $table->string('filename', 255)->nullable();
      $table->timestamps();
    });
  }
  public function down(){
    Schema::dropIfExists('sitemaps');
  }
}