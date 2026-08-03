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
        Schema::table('app_settings', function (Blueprint $table) {
            $table->boolean('advertise_enabled')->default(true)->after('service_charge');
            $table->integer('advertise_default_point')->default(50)->after('advertise_enabled');
            $table->string('advertise_default_status')->default('active')->after('advertise_default_point');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('app_settings', function (Blueprint $table) {
            $table->dropColumn([
                'advertise_enabled',
                'advertise_default_point',
                'advertise_default_status',
            ]);
        });
    }
};
