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
        Schema::create('sales_man_terrs', function (Blueprint $table) {
            $table->integer('sales_ter_id')->nullable();
            $table->integer('sales_code')->nullable();
            $table->integer('sales_id')->nullable();
            $table->integer('route_type_id')->nullable();
            $table->string('name')->nullable();
            $table->string('position')->nullable();
            $table->string('address')->nullable();
            $table->integer('tel_num')->nullable();
            $table->string('mobile')->nullable();
            $table->string('martial')->nullable();
            $table->string('occupation')->nullable();
            $table->string('education')->nullable();
            $table->date('birthdate')->nullable();
            $table->date('join_date');
            $table->integer('van_id')->nullable();
            $table->string('status')->nullable();
            $table->integer('manager_id')->nullable();
            $table->string('sales_code_char')->nullable();
            $table->date('from_date');
            $table->date('to_date');
            $table->timestamp('entry_date');
            $table->date('updated_date');
            $table->integer('active')->nullable();
            $table->date('handover_date')->nullable();
            $table->date('handover_posting_date')->nullable();
            $table->string('action')->nullable();
            $table->string('trans_flag')->nullable();
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
        Schema::dropIfExists('sales_man_terrs');
    }
};
