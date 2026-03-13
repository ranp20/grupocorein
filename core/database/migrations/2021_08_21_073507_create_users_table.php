<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateUsersTable extends Migration{
  public function up(){
    Schema::create('users', function (Blueprint $table) {
      $table->id();
      $table->string('first_name')->nullable();
      $table->string('last_name')->nullable();
      $table->string('phone')->nullable();
      $table->string('email')->nullable();
      $table->string('photo')->nullable();
      $table->string('email_token')->nullable();
      $table->string('password')->nullable();
      $table->char('reg_enterprise', 3)->nullable();
      $table->string('reg_address1')->nullable();
      $table->string('reg_address2')->nullable();
      $table->char('reg_ruc', 22)->nullable();
      $table->string('reg_razonsocial')->nullable();
      $table->string('reg_addressfiscal')->nullable();
      $table->char('reg_codepostal', 6)->nullable();
      $table->integer('reg_country_id')->nullable();
      $table->integer('reg_departamento_id')->nullable();
      $table->integer('reg_provincia_id')->nullable();
      $table->integer('reg_distrito_id')->nullable();
      $table->string('reg_streetaddress')->nullable();
      $table->string('reg_referenceaddress')->nullable();
      $table->string('reg_addresseeaddress')->nullable();
      $table->string('ship_address1')->nullable();
      $table->string('ship_address2')->nullable();
      $table->string('ship_zip')->nullable();
      $table->string('ship_city')->nullable();
      $table->string('ship_country')->nullable();
      $table->string('ship_company')->nullable();
      $table->string('bill_address1')->nullable();
      $table->string('bill_address2')->nullable();
      $table->string('bill_zip')->nullable();
      $table->string('bill_city')->nullable();
      $table->string('bill_country')->nullable();
      $table->string('bill_company')->nullable();
      $table->integer('state_id')->nullable();
      $table->text('coupon_to_products')->nullable();
      $table->timestamps();
    });
  }
  public function down(){
    Schema::dropIfExists('users');
  }
}