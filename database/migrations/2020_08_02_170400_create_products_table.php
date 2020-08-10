<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained()->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('brand_name')->nullable();
            $table->string('model')->nullable();
            $table->string('input_power')->nullable();
            $table->string('input_voltage')->nullable();
            $table->string('working_frequency')->nullable();
            $table->string('lumen')->nullable();
            $table->string('cct')->nullable();
            $table->string('cri')->nullable();
            $table->string('life_span')->nullable();
            $table->string('size')->nullable();
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
        Schema::dropIfExists('products');
    }
}
