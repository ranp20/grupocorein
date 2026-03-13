<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class AddStateIdToUsersTable extends Migration{
  public function up(){
    Schema::table('users', function (Blueprint $table) {
      $table->integer('state_id')->nullable();
    });
  }
  public function down(){
    Schema::table('users', function (Blueprint $table) {
      //
    });
  }
}