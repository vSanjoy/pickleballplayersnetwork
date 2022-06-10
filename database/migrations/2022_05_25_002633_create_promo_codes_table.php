<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromoCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promo_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->text('code')->nullable();
            $table->enum('discount_type', ['F','P'])->default('F')->comment('F=>Flat, P=>Percent');
            $table->double('amount',10,2)->default(0)->comment('Flat/Percent discount amount');
            $table->enum('is_one_time_use', ['N','Y'])->default('N')->comment('N=>No, Y=>Yes');
            $table->integer('maximum_number_of_use')->nullable();
            $table->enum('is_used', ['N','Y'])->default('N')->comment('N=>No, Y=>Yes');
            $table->timestamp('start_date_time')->nullable();
            $table->timestamp('end_date_time')->nullable();
            $table->integer('start_time')->nullable();
            $table->integer('end_time')->nullable();
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
        Schema::dropIfExists('promo_codes');
    }
}
