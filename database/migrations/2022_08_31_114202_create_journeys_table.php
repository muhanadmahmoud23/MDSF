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
        Schema::create('journeys', function (Blueprint $table) {
            $table->integer('sales_ter_id')->nullable();
            $table->bigInteger('jou_id')->nullable();
            $table->integer('route_id')->nullable();
            $table->integer('sales_rep_id')->nullable();
            $table->timestamp('start_date');
            $table->dateTime('end_date');
            $table->integer('van_id')->nullable();
            $table->integer('beg_km')->nullable();
            $table->integer('end_km')->nullable();
            $table->bigInteger('jou_seq')->nullable();
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
        Schema::dropIfExists('journeys');
    }
};
