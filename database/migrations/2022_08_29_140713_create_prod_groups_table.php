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
        Schema::create('prod_groups', function (Blueprint $table) {
            $table->integer('prod_group_id');
            $table->string('name');
            $table->timestamp('entry_date');
            $table->date('update_date')->nullable();
            $table->string('action');
            $table->string('trans_flag');
            $table->string('company_flag');
            $table->integer('branch_code');
            $table->integer('activity_flag');
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
        Schema::dropIfExists('prod_groups');
    }
};
