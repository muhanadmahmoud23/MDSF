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
        Schema::create('dcs', function (Blueprint $table) {
            $table->integer('DC_ID');
            $table->string('DC_Code')->nullable();
            $table->string('Name');
            $table->integer('sales_reg_id');
            $table->timestamp('entry_date');
            $table->date('update_date')->nullable();
            $table->string('DESC_DC')->nullable();
            $table->string('action');
            $table->string('trans_flag');
            $table->integer('branch_code');
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
        Schema::dropIfExists('dcs');
    }
};
