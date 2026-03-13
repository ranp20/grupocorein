<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class AddDisqusToSettingsTable extends Migration{
  public function up(){
    Schema::table('settings', function (Blueprint $table) {
      $table->text('disqus')->nullable();
      $table->tinyInteger('is_disqus')->default(0);
    });
  }
  public function down(){
    Schema::table('settings', function (Blueprint $table) {
      //
    });
  }
}