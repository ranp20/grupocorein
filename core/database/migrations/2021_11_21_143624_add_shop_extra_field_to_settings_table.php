<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class AddShopExtraFieldToSettingsTable extends Migration{
  public function up(){
    Schema::table('settings', function (Blueprint $table) {
      $table->tinyInteger('is_attribute_search')->nullable()->default(1);
      $table->tinyInteger('is_range_search')->nullable()->default(1);
      $table->integer('view_product')->nullable()->default(12);
    });
  }
  public function down(){
    Schema::table('settings', function (Blueprint $table) {
      //
    });
  }
}