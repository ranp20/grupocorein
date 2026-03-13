<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateTrackOrdersTable extends Migration{
  public function up(){
    Schema::create('track_orders', function (Blueprint $table) {
      $table->id();
      $table->integer('order_id')->nullable();
      $table->string('title')->nullable();
      $table->timestamps();
    });
  }
  public function down(){
    Schema::dropIfExists('track_orders');
  }
}