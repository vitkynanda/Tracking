<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->string('resi_by_system');
            $table->string('container_name');
            $table->string('client_name');
            $table->string('origin_name');
            $table->string('destination_name');
            $table->string('delivery_type');
            $table->string('delivery_status');
            $table->string('rec_usercreated');
            $table->string('rec_userupdated');
            $table->tinyInteger('rec_status');
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
        Schema::dropIfExists('deliveries');
    }
}
