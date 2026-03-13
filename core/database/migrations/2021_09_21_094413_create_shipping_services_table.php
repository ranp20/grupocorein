<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateShippingServicesTable extends Migration{
  public function up(){
    Schema::create('shipping_services', function (Blueprint $table) {
      $table->id();
      $table->string('title')->nullable();
      $table->integer('departamento_id');
      $table->integer('provincia_id');
      $table->integer('distrito_id');
      $table->double('price')->default(0);
      $table->tinyInteger('status')->default(0);
      $table->timestamps();
    });
  }
  public function down(){
    Schema::dropIfExists('shipping_services');
  }
}