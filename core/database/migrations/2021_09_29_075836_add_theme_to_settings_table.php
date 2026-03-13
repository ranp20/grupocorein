<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class AddThemeToSettingsTable extends Migration{
  public function up(){
    Schema::table('settings', function (Blueprint $table) {
      $table->string('theme')->nullable();
    });
  }
  public function down(){
    Schema::table('settings', function (Blueprint $table) {
      $table->dropColumn(
        'theme'
      );
    });
  }
}