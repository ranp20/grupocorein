<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class AddHome4populerCategoryToHomeCutomizesTable extends Migration{
  public function up(){
    Schema::table('home_cutomizes', function (Blueprint $table) {
      $table->text('home_4_popular_category')->nullable();
    });
  }
  public function down(){
    Schema::table('home_cutomizes', function (Blueprint $table) {
      //
    });
  }
}