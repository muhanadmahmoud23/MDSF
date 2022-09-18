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
        Schema::create('vans', function (Blueprint $table) {
            $table->integer('van_id')->nullable();
            $table->integer('van_code')->nullable();
            $table->string('model')->nullable();
            $table->integer('manu_year')->nullable();
            $table->string('car_num')->nullable();
            $table->integer('license')->nullable();
            $table->string('eng_num')->nullable();
            $table->string('bod_num')->nullable();
            $table->timestamp('entry_date');
            $table->date('updated_date')->nullable();
            $table->integer('temp')->nullable();
            $table->integer('FMS')->nullable();
            $table->integer('active')->nullable();
            $table->integer('fms_flag')->nullable();
            $table->string('company')->nullable();
            $table->string('action')->nullable();
            $table->string('trans_flag')->nullable();
            $table->integer('cases_count')->nullable();
            $table->integer('branch_code')->nullable();
            $table->integer('eng_num_back')->nullable();
            $table->integer('bod_num_back')->nullable();
            $table->date('regisration_date')->nullable();
            $table->integer('ending_km')->nullable();
            $table->integer('counter_change_date')->nullable();
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
        Schema::dropIfExists('vans');
    }
};
