<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFailedShopItemParseFromCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('failed_shop_item_parse_from_categories', function (Blueprint $table) {
            $table->id();
            $table->integer('category_code');
            $table->text('error_message');
            $table->boolean('actuality');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('failed_shop_item_parse_from_categories');
    }
}
