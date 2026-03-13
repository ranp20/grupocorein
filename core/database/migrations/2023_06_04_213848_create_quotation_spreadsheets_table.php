<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateQuotationSpreadsheetsTable extends Migration{
  public function up(){
    Schema::create('tbl_quotation_spreadsheets', function (Blueprint $table) {
      $table->id();
      $table->string('spreadsheet')->nullable();
      $table->timestamps();
    });
  }
  public function down(){
    Schema::dropIfExists('tbl_quotation_spreadsheets');
  }
}