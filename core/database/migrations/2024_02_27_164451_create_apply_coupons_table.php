<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateApplyCouponsTable extends Migration{
  public function up(){
    Schema::create('tbl_applycoupons', function (Blueprint $table) {
      $table->id();
      $table->integer('id_user');
      $table->integer('id_prod');
      $table->integer('id_coupon');
      $table->double('totalprice', 12, 2)->default(0)->nullable();
      $table->tinyInteger('status')->default()->nullable();
      $table->timestamps();
    });
  }
  public function down(){
    Schema::dropIfExists('tbl_applycoupons');
  }
}