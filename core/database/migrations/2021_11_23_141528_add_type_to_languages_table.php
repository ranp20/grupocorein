<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class AddTypeToLanguagesTable extends Migration{
  public function up(){
    Schema::table('languages', function (Blueprint $table) {
      $table->string('type')->nullable();
    });
  }
  public function down(){
    Schema::table('languages', function (Blueprint $table) {
      //
    });
  }
}