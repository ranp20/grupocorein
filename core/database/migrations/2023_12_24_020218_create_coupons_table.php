<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateCouponsTable extends Migration{
  public function up(){
    Schema::create('tbl_coupons', function (Blueprint $table) {
      $table->id();
      $table->string('name')->unique()->nullable();
      $table->decimal('discount_percentage', 5, 2);
      $table->string('photo')->nullable();
      $table->date('date_init')->nullable();
      $table->date('date_end')->nullable();
      $table->dateTime('time_end')->nullable();
      $table->tinyInteger('status')->default()->nullable();
      $table->timestamps();
    });
  }
  public function down(){
    Schema::dropIfExists('tbl_coupons');
  }
}