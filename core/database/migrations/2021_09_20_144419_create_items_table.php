<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateItemsTable extends Migration{
  public function up(){
    Schema::create('items', function (Blueprint $table) {
      $table->id();
      $table->integer('category_id')->default(0)->nullable();
      $table->integer('subcategory_id')->default(0)->nullable();
      $table->integer('childcategory_id')->default(0)->nullable();
      $table->integer('tax_id')->nullable();
      $table->integer('sections_id')->nullable();
      $table->integer('brand_id')->default(0)->nullable();
      $table->integer('coupon_id')->default(0)->nullable();
      $table->integer('unidad_raiz')->default(0)->nullable();
      $table->integer('atributo_raiz')->default(0)->nullable();
      $table->text('atributoraiz_collection')->nullable();
      $table->text('name')->nullable();
      $table->text('slug')->nullable();
      $table->string('sku')->nullable();
      $table->text('tags')->nullable();
      $table->text('video')->nullable();
      $table->text('sort_details')->nullable();
      $table->text('specification_name')->nullable();
      $table->text('specification_description')->nullable();
      $table->tinyInteger('is_specification')->default(0)->nullable();
      $table->text('specification_collection')->nullable();
      $table->text('details')->nullable();
      $table->string('photo')->nullable();
      $table->double('discount_price')->default(0)->nullable();
      $table->double('previous_price')->default(0)->nullable();
      $table->string('on_sale_price')->nullable();
      $table->string('special_offer_price')->nullable();
      $table->string('store_availables')->nullable();
      $table->integer('stock')->default(0)->nullable();
      $table->text('meta_keywords')->nullable();
      $table->text('meta_description')->nullable();
      $table->tinyInteger('status')->default()->nullable();
      $table->string('is_type')->nullable();
      $table->string('date')->nullable();
      $table->string('file')->nullable();
      $table->text('link')->nullable();
      $table->enum('file_type',['file', 'link'])->nullable();
      $table->text('license_name')->nullable();
      $table->text('license_key')->nullable();
      $table->enum('item_type',['normal', 'digital'])->default('normal');
      $table->string('thumbnail', 255)->nullable();
      $table->text('affiliate_link')->nullable();
      $table->text('sap_code')->nullable();
      $table->text('adj_doc')->nullable();
      $table->timestamps();
    });
  }
  public function down(){
    Schema::dropIfExists('items');
  }
}