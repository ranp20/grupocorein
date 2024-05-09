<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateStoresTable extends Migration{
  public function up(){
    Schema::create('tbl_stores', function (Blueprint $table) {
      $table->id();
      $table->text('name')->nullable();
      $table->text('telephone')->nullable();
      $table->text('address')->nullable();
      $table->text('photo')->nullable();
      $table->timestamps();
    });
  }
  public function down(){
    Schema::dropIfExists('tbl_stores');
  }
}