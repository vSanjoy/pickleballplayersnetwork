<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaguesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leagues', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->integer('zip')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->integer('state_id')->nullable()->comment('Id from states table');
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->enum('play_type', ['S','D'])->default('D')->comment('S=>Singles, D=>Doubles');
            $table->enum('gender', ['M','F','MX'])->default('M')->comment('M=>Male, F=>Female, MX=>Mixed');
            $table->string('rating')->nullable()->comment('Rating range');
            $table->float('rating_start', 5, 2)->nullable()->comment('Rating start');
            $table->float('rating_end', 5, 2)->nullable()->comment('Rating end');
            $table->timestamp('start_date_time')->nullable();
            $table->timestamp('end_date_time')->nullable();
            $table->integer('start_time')->nullable();
            $table->integer('end_time')->nullable();
            $table->integer('maximum_registration_allowed')->default(30)->comment('Maximum team can register');
            $table->float('amount', 10, 2)->default(2)->comment('Registration amount fo the league');
            $table->enum('league_status', ['RO','IP','PO','CP'])->default('RO')->comment('RO=>Registration Open, IP=>In-Progress, PO=>Playoffs, CP=>Complete');
            $table->integer('sort')->default('0');
            $table->enum('status', ['0','1'])->default('1')->comment('0=>Inactive, 1=>Active');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('NULL ON UPDATE CURRENT_TIMESTAMP'))->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leagues');
    }
}
