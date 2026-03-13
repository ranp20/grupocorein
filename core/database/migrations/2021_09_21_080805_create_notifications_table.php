<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateNotificationsTable extends Migration{
  public function up(){
    Schema::create('notifications', function (Blueprint $table) {
      $table->id();
      $table->integer('order_id')->nullable();
      $table->integer('user_id')->nullable();
      $table->tinyInteger('is_read')->default(0);
      $table->timestamps();
    });
  }
  public function down(){
    Schema::dropIfExists('notifications');
  }
}