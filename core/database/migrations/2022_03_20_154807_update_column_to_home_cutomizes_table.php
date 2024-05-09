<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class UpdateColumnToHomeCutomizesTable extends Migration{
  public function up(){
    Schema::table('home_cutomizes', function (Blueprint $table) {
      $table->text('hero_banner')->change();
    });
  }
  public function down(){
    Schema::table('home_cutomizes', function (Blueprint $table) {
      //
    });
  }
}