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
        Schema::create('sales_regs', function (Blueprint $table) {
            $table->integer('sales_reg_id');
            $table->string('sales_reg_code')->nullable();
            $table->string('Name');
            $table->timestamp('entry_date');
            $table->date('update_date');
            $table->string('aname')->nullable();
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
        Schema::dropIfExists('sales_regs');
    }
};
