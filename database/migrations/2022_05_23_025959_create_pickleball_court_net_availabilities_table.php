<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePickleballCourtNetAvailabilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pickleball_court_net_availabilities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pickleball_court_id')->nullable()->comment('Id from pickleball_courts table');
            $table->string('net_id')->nullable()->comment('Id from nets table');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pickleball_court_net_availabilities');
    }
}
