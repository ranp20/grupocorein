<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateProvinciasTable extends Migration{
  public function up(){
    Schema::create('tbl_provincias', function (Blueprint $table) {
      $table->id();
      $table->integer('departamento_code')->default(0)->nullable();
      $table->integer('provincia_code')->default(0)->nullable();
      $table->text('provincia_name')->nullable();
      $table->timestamps();
    });
  }
  public function down(){
    Schema::dropIfExists('tbl_provincias');
  }
}