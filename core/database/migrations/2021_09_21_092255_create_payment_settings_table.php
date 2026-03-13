<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreatePaymentSettingsTable extends Migration{
  public function up(){
    Schema::create('payment_settings', function (Blueprint $table) {
      $table->id();
      $table->string('name')->nullable();
      $table->text('information')->nullable();
      $table->string('unique_keyword')->nullable();
      $table->string('photo')->nullable();
      $table->text('text')->nullable();
      $table->tinyInteger('status')->default(0);
      $table->timestamps();
    });
  }
  public function down(){
    Schema::dropIfExists('payment_settings');
  }
}