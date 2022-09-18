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
        Schema::create('warehouses', function (Blueprint $table) {
            $table->integer('warehouse_id');
            $table->string('warehouse_name');
            $table->string('def_warehouse');
            $table->string('warehouse_code');
            $table->string('warehouse_desc')->nullable();
            $table->text('warehouse_address')->nullable();
            $table->integer('zip_code')->nullable();
            $table->string('warehouse_city')->nullable();
            $table->integer('dc_id_sfis')->nullable();
            $table->integer('branch_code')->nullable();
            $table->string('to_sla_LNK')->nullable();
            $table->integer('sales_office')->nullable();
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
        Schema::dropIfExists('warehouses');
    }
};
