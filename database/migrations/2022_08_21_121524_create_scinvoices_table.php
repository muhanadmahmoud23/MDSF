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
        Schema::create('scinvoices', function (Blueprint $table) {
            $table->id();
            $table->integer('prod_id');
            $table->integer('Uom_id')->nullable();
            $table->string('Quantity')->nullable();
            $table->integer('Total_value')->nullable();
            $table->integer('incentive_value')->nullable();
            $table->integer('net_value')->nullable();
            $table->integer('loading_number')->nullable();
            $table->string('salescall_details_id')->nullable();
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
        Schema::dropIfExists('scinvoices');
    }
};
