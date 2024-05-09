<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class AddGuestHeroBannerToHomeCutomizesTable extends Migration{
  public function up(){
    Schema::table('home_cutomizes', function (Blueprint $table) {
      $table->string('hero_banner')->nullable()->default('[]');
    });
  }
  public function down(){
    Schema::table('home_cutomizes', function (Blueprint $table) {
      //
    });
  }
}