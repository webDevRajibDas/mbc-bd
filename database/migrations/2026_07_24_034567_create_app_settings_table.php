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
        Schema::create('app_settings', function (Blueprint $table) {
            $table->id();
            $table->string('brand_name')->default('MBC Bangladesh.com');
            $table->string('logo')->nullable();
            $table->string('navbar_color')->default('#1f6fb8');
            $table->string('header_color')->default('#0c6b5e');
            $table->string('social_youtube')->nullable();
            $table->string('social_facebook')->nullable();
            $table->string('social_community')->nullable();
            $table->string('social_messenger')->nullable();
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
        Schema::dropIfExists('app_settings');
    }
};
