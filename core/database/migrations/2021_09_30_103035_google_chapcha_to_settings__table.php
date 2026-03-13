<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class GoogleChapchaToSettingsTable extends Migration{
  public function up(){
    Schema::table('settings', function (Blueprint $table) {
      $table->string('google_recaptcha_site_key')->nullable();
      $table->string('google_recaptcha_secret_key')->nullable();
      $table->tinyInteger('recaptcha')->default(0)->nullable();
    });
  }
  public function down(){
    Schema::table('settings', function (Blueprint $table) {
      //
    });
  }
}