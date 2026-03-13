<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class AddGuestCheckoutToSettingsTable extends Migration{
  public function up(){
    Schema::table('settings', function (Blueprint $table) {
      $table->tinyInteger('is_guest_checkout')->default(1)->nullable();
    });
  }
  public function down(){
    Schema::table('settings', function (Blueprint $table) {
      //
    });
  }
}