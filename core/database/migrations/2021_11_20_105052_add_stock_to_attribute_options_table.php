<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class AddStockToAttributeOptionsTable extends Migration{
  public function up(){
    Schema::table('attribute_options', function (Blueprint $table) {
      $table->string('stock')->default('unlimited')->nullable();
    });
  }
  public function down(){
    Schema::table('attribute_options', function (Blueprint $table) {
      //
    });
  }
}