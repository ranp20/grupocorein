<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class AddTypeToStatesTable extends Migration{
  public function up(){
    Schema::table('states', function (Blueprint $table) {
      $table->string('type')->nullable();
    });
  }
  public function down(){
    Schema::table('states', function (Blueprint $table) {
      //
    });
  }
}