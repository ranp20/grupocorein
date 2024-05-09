<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateQuotationSpreadsheetsValuesTable extends Migration{
  public function up(){
    Schema::create('tbl_quotation_spreadsheets_values', function (Blueprint $table) {
      $table->id();
      $table->string('distrito_code')->nullable();
      $table->string('distrito_nombre')->nullable();
      $table->string('provincia_code')->nullable();
      $table->string('provincia_nombre')->nullable();
      $table->string('departamento_code')->nullable();
      $table->string('departamento_nombre')->nullable();
      $table->string('min_amount')->nullable();
      $table->string('max_amount')->nullable();
      $table->timestamps();
    });
  }
  public function down(){
    Schema::dropIfExists('tbl_quotation_spreadsheets_values');
  }
}