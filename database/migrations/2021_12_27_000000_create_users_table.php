<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nickname')->nullable();
            $table->string('title')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('full_name')->nullable();
            $table->string('username')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('password')->nullable();
            $table->string('profile_pic')->nullable();
            $table->enum('gender', ['M','F','U'])->default('M')->comment('M=>Male, F=>Female, U=>Prefer not to answer');
            $table->dateTime('dob')->nullable()->comment('Date of birth');
            $table->float('player_rating', 10, 2)->default(2)->comment('Player rating');
            $table->integer('role_id')->nullable();
            $table->string('remember_token')->nullable();
            $table->string('auth_token')->nullable();
            $table->enum('type', ['SA','A','U'])->default('U')->comment('SA=>Super Admin, A=>Sub Admin, U=>User');
            $table->enum('agree', ['N','Y'])->default('Y')->comment('N=>No, Y=>Yes');
            $table->enum('is_waiver_signed', ['N','Y'])->default('Y')->comment('N=>No, Y=>Yes');
            $table->enum('status', ['0','1'])->default('1')->comment('0=>Inactive, 1=>Active');
            $table->enum('send_score_confirmation', ['N','Y'])->default('N')->comment('N=>No, Y=>Yes');
            $table->integer('lastlogintime')->nullable();
            $table->enum('sample_login_show', ['N','Y'])->default('N')->comment('Y=>Yes, N=>No');
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
        Schema::dropIfExists('users');
    }
}
