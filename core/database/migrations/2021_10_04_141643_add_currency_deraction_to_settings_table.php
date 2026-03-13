<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class AddCurrencyDeractionToSettingsTable extends Migration{
  public function up(){
    Schema::table('settings', function (Blueprint $table) {
      $table->tinyInteger('currency_direction')->default(1)->nullable();
    });
  }
  public function down(){
    Schema::table('settings', function (Blueprint $table) {
      //
    });
  }
}