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
        Schema::create('sales_call_details', function (Blueprint $table) {
            $table->string('salescall_id')->nullable();
            $table->string('salescall_details_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->string('payment_id')->nullable();
            $table->string('total_invoice')->nullable();
            $table->string('incentive_amount')->nullable();
            $table->string('net_amout')->nullable();
            $table->string('tax_amount')->nullable();
            $table->string('phone')->nullable();
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->string('oursource_order')->nullable();
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
        Schema::dropIfExists('sales_call_details');
    }
};
