<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateTaxesTable extends Migration{
  public function up(){
    Schema::create('taxes', function (Blueprint $table) {
      $table->id();
      $table->string('name')->nullable();
      $table->double('value')->nullable();
      $table->tinyInteger('status')->default(0)->nullable();
      $table->timestamps();
    });
  }
  public function down(){
    Schema::dropIfExists('taxes');
  }
}