<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class HomePage4ToHomeCutomizesTable extends Migration{
  public function up(){
    Schema::table('home_cutomizes', function (Blueprint $table) {
      $table->text('home_page4')->nullable();
    });
  }
  public function down(){
    Schema::table('home_cutomizes', function (Blueprint $table) {
      //
    });
  }
}