<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->text('short_title')->nullable();
            $table->text('short_description')->nullable();
            $table->string('image')->nullable();
            $table->text('image_title')->nullable();
            $table->text('image_alt')->nullable();
            $table->string('image_mobile')->nullable();
            $table->text('image_title_mobile')->nullable();
            $table->text('image_alt_mobile')->nullable();
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
        Schema::dropIfExists('banners');
    }
}
