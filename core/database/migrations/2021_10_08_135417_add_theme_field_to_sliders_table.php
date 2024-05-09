<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class AddThemeFieldToSlidersTable extends Migration{
  public function up(){
    Schema::table('sliders', function (Blueprint $table) {
      $table->string('home_page')->nullable()->default('theme1');
    });
  }
  public function down(){
    Schema::table('sliders', function (Blueprint $table) {
      //
    });
  }
}