<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateComplaintsBooksTable extends Migration{
  public function up(){
    Schema::create('tbl_complaints_books', function (Blueprint $table) {
      $table->id();
      $table->string('cmptbk_codegen')->nullable();
      $table->string('cmptbk_name')->nullable();
      $table->string('cmptbk_departamento_id')->nullable();
      $table->string('cmptbk_provincia_id')->nullable();
      $table->string('cmptbk_distrito_id')->nullable();
      $table->string('cmptbk_domicilio')->nullable();
      $table->string('cmptbk_dni_ce')->nullable();
      $table->string('cmptbk_ruc')->nullable();
      $table->string('cmptbk_razonsocial')->nullable();
      $table->string('cmptbk_telefono')->nullable();
      $table->string('cmptbk_email')->nullable();
      $table->string('cmptbk_typeofclaim')->nullable();
      $table->string('cmptbk_detail')->nullable();
      $table->string('cmptbk_order')->nullable();
      $table->tinyInteger('cmptbk_agecheck')->default()->nullable();
      $table->string('cmptbk_datayounger')->nullable();
      $table->string('cmptbk_typeofgod')->nullable();
      $table->double('cmptbk_reclaimedamount', 12, 2)->default(0)->nullable();
      $table->string('cmptbk_description')->nullable();
      $table->timestamps();
    });
  }
  public function down(){
    Schema::dropIfExists('tbl_complaints_books');
  }
}