<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateRootAttributesTable extends Migration{
  public function up(){
    Schema::create('tbl_atributoraiz', function (Blueprint $table) {
      $table->id();
      $table->string('name')->nullable();
      $table->timestamps();
    });
  }
  public function down(){
    Schema::dropIfExists('tbl_atributoraiz');
  }
}