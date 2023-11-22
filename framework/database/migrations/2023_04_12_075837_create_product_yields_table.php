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
        Schema::create('product_yields', function (Blueprint $table) {
            $table->id();
            $table->string('site_name');
            $table->text('site_details')->nullable();
            $table->date('date');
            $table->time('time');
            $table->string('shift_details');
            $table->unsignedInteger('shift_incharge_id');
            $table->text('shift_yield');
            $table->text('daily_yield');
            $table->text('daily_quantity');
            $table->text('wastage')->nullable();
            $table->text('shift_yield_details');
            $table->text('site_production_details');
            $table->text('stock_details');
            $table->text('product_transfer');
            $table->text('shift_quantity');
            $table->text('yield_quality');
            $table->text('custom_field')->nullable();
            $table->text('deleted_at')->nullable();
            $table->text('status');
            $table->timestamps();

            $table->foreign('shift_incharge_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_yields');
    }
};
