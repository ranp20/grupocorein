<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateMessagesTable extends Migration{
  public function up(){
    Schema::create('messages', function (Blueprint $table) {
      $table->id();
      $table->integer('ticket_id')->nullable();
      $table->integer('user_id')->nullable();
      $table->string('message')->nullable();
      $table->timestamps();
    });
  }
  public function down(){
    Schema::dropIfExists('messages');
  }
}