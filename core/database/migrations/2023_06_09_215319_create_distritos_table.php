<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateDistritosTable extends Migration{
  public function up(){
    Schema::create('tbl_distritos', function (Blueprint $table) {
      $table->id();
      $table->integer('departamento_code')->default(0)->nullable();
      $table->integer('provincia_code')->default(0)->nullable();
      $table->integer('distrito_code')->default(0)->nullable();
      $table->text('distrito_name')->nullable();
      $table->double('distrito_min_amount', 12, 2)->nullable();
      $table->double('distrito_max_amount', 12, 2)->nullable();
      $table->timestamps();
    });
  }
  public function down(){
    Schema::dropIfExists('tbl_distritos');
  }
}