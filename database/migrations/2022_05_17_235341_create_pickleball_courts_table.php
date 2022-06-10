<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePickleballCourtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pickleball_courts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->integer('state_id')->nullable()->comment('Id from states table');
            $table->string('city')->nullable();
            $table->text('address')->nullable();
            $table->text('address_2')->nullable();
            $table->string('zip')->nullable();
            $table->enum('accessibility', ['PR','PL','U'])->nullable()->comment('PR=>Private, PL=>Public, U=>Unknown');
            $table->enum('indoor_outdoor', ['ID','OD','B','U'])->nullable()->comment('ID=>Indoor, OD=>Outdoor, B=>Both, U=>Unknown');
            $table->string('number_of_courts')->nullable();
            $table->enum('lights', ['N','Y','U'])->nullable()->comment('N=>No, Y=>Yes, U=>Unknown');
            $table->enum('cost', ['FP','DIF','MP','U'])->nullable()->comment('FP=>Free to Play, DIF=>Drop-In Fee, MP=>Membership Fee, U=>Unknown');
            $table->enum('reservations_requirements', ['N','Y','U'])->nullable()->comment('N=>No, Y=>Yes, U=>Unknown');
            $table->string('phone_no')->nullable();
            $table->string('website')->nullable();
            $table->integer('entered_by_user_id')->nullable()->comment('Entered By');
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
        Schema::dropIfExists('pickleball_courts');
    }
}
