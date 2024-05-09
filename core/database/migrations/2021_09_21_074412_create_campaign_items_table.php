<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateCampaignItemsTable extends Migration{
  public function up(){
    Schema::create('campaign_items', function (Blueprint $table) {
      $table->id();
      $table->integer('item_id');
      $table->tinyInteger('status')->default()->nullable();
      $table->tinyInteger('is_feature')->default(0)->nullable();
      $table->timestamps();
    });
  }
  public function down(){
    Schema::dropIfExists('campaign_items');
  }
}