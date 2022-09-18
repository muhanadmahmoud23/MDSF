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
        Schema::create('sales_calls', function (Blueprint $table) {
            $table->string('sales_call_id')->nullable();
            $table->integer('sales_ter_id')->nullable();
            $table->string('jou_id')->nullable();
            $table->string('pos_code')->nullable();
            $table->integer('route_id')->nullable();
            $table->string('call_status_id')->nullable();
            $table->integer('reason_id')->nullable();
            $table->timestamp('start_time');
            $table->dateTime('end_time');
            $table->string('payment_id')->nullable();
            $table->string('total_invoice')->nullable();
            $table->string('incentive_amount')->nullable();
            $table->string('net_amount')->nullable();
            $table->string('tax_amount')->nullable();
            $table->integer('branch_code')->nullable();
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
        Schema::dropIfExists('sales_calls');
    }
};
