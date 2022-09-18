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
        Schema::create('sales_terrs', function (Blueprint $table) {
            $table->integer('sales_terr_id');
            $table->string('sales_ter_code')->nullable();
            $table->string('name');
            $table->integer('dc_id');
            $table->integer('prod_group_id')->nullable();
            $table->integer('route_type_id');
            $table->timestamp('entry_date');
            $table->date('update_date')->nullable();
            $table->integer('food_ws_rt')->nullable();
            $table->string('action');
            $table->string('trans_flag');
            $table->integer('seq')->nullable();
            $table->integer('reg_id')->nullable();
            $table->string('sectors')->nullable();
            $table->integer('sector_id')->nullable();
            $table->integer('branch_code');
            $table->string('allow_sell_comp')->nullable();
            $table->integer('No_overlap_allow_sell_comp')->nullable();
            $table->string('stock_by_comp');
            $table->string('div');
            $table->integer('warehouse_id')->nullable();
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
        Schema::dropIfExists('sales_terrs');
    }
};
