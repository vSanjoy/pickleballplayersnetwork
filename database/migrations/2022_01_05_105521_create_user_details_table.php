<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable()->comment('Id from users table');
            $table->string('home_court')->nullable()->comment('Preferred Home Court');
            $table->text('address_line_1')->nullable()->comment('Address line 1');
            $table->text('address_line_2')->nullable()->comment('Address line 2');
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
            $table->enum('how_did_you_find_us', ['SE','SM','RBF','BOP','AD','O'])->nullable()->comment('SE=>Search engine (Google, Yahoo, etc.), SM=>Social Media (Facebook, Instagram, etc.), RBF=>Recommended by a friend, BOP=>Blog or Publication, AD=>Advertisement, O=>Other');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_details');
    }
}
