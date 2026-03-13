<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class AddAnnouncementLinkToSettingsTable extends Migration{
  public function up(){
    Schema::table('settings', function (Blueprint $table) {
      $table->text('announcement_link')->nullable();
    });
  }
  public function down(){
    Schema::table('settings', function (Blueprint $table) {
      //
    });
  }
}