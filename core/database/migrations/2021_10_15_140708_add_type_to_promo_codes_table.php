<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class AddTypeToPromoCodesTable extends Migration{
  public function up(){
    Schema::table('promo_codes', function (Blueprint $table) {
      $table->string('type')->nullable();
    });
  }
  public function down(){
    Schema::table('promo_codes', function (Blueprint $table) {
      //
    });
  }
}