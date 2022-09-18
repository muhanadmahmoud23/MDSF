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
        Schema::create('route_types', function (Blueprint $table) {
            $table->integer('route_type_id');
            $table->string('route_type_code');
            $table->string('name');
            $table->integer('UOM_Unit');
            $table->integer('channel_id')->nullable();
            $table->timestamp('entry_date');
            $table->date('update_date')->nullable();
            $table->string('action');
            $table->string('trans_flag');
            $table->integer('UOM_id');
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
        Schema::dropIfExists('route_types');
    }
};
