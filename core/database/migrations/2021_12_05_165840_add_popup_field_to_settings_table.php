<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class AddPopupFieldToSettingsTable extends Migration{
  public function up(){
    Schema::table('settings', function (Blueprint $table) {
      $table->string('announcement_title')->nullable();
      $table->string('announcement_type')->default('banner')->nullable();
      $table->tinyInteger('is_cookie')->default(1)->nullable();
      $table->string('cookie_text')->nullable();
      $table->text('announcement_details')->nullable();
    });
  }
  public function down(){
    Schema::table('settings', function (Blueprint $table) {
      //
    });
  }
}