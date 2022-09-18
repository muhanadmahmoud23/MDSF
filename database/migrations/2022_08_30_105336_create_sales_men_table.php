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
        Schema::create('sales_men', function (Blueprint $table) {
            $table->integer('sales_id')->nullable();
            $table->integer('sales_code')->nullable();
            $table->string('sales_code_char')->nullable();
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->string('tel_num')->nullable();
            $table->string('mobile')->nullable();
            $table->string('martial')->nullable();
            $table->string('occupation')->nullable();
            $table->string('education')->nullable();
            $table->date('birthdate')->nullable();
            $table->date('join_date')->nullable();
            $table->string('status')->nullable();
            $table->timestamp('entry_date');
            $table->date('update_date')->nullable();
            $table->integer('km')->nullable();
            $table->string('prs')->nullable();
            $table->string('census')->nullable();
            $table->string('key_flag')->nullable();
            $table->string('call_card')->nullable();
            $table->string('action')->nullable();
            $table->string('trans_flag')->nullable();
            $table->string('active')->nullable();
            $table->string('salestype')->nullable();
            $table->integer('insurance')->nullable();
            $table->integer('branch_code')->nullable();
            $table->string('E_name')->nullable();
            $table->integer('dc')->nullable();
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
        Schema::dropIfExists('sales_men');
    }
};
