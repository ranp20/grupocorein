<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateEmailTemplatesTable extends Migration{
  public function up(){
    Schema::create('email_templates', function (Blueprint $table) {
      $table->id();
      $table->string('type')->nullable();
      $table->text('subject')->nullable();
      $table->mediumText('body')->nullable();
      $table->timestamps();
    });
  }
  public function down(){
    Schema::dropIfExists('email_templates');
  }
}