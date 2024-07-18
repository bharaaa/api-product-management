<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_product', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->uuid("product_category_id")->nullable(false);
            $table->string("name", 150)->nullable(false);
            $table->bigInteger("price")->nullable(false);
            $table->string("image", 255);
            $table->longText("image_url");
            $table->boolean("is_active")->default(true);
            $table->timestamps();

            $table->foreign("product_category_id")->on("m_category_product")->references("id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
};
