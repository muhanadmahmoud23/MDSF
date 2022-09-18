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
        Schema::create('regions', function (Blueprint $table) {
            $table->integer('reg_id');
            $table->string('reg_code')->nullable();
            $table->string('name');
            $table->string('name_e');
            $table->timestamp('entry_date');
            $table->date('update_date')->nullable();
            $table->string('reg_census_code')->nullable();
            $table->string('reg_name')->nullable();
            $table->string('action');
            $table->string('trans_flag');
            $table->string('branch_code');
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
        Schema::dropIfExists('regions');
    }
};
