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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('officer_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('full_name')->nullable();
            $table->string('guardian_name')->nullable();
            $table->string('nid_no')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('gender')->nullable();
            $table->foreignId('division_id')->nullable()->constrained('divisions')->onDelete('set null');
            $table->foreignId('district_id')->nullable()->constrained('districts')->onDelete('set null');
            $table->foreignId('upazila_id')->nullable()->constrained('upazilas')->onDelete('set null');
            $table->foreignId('union_id')->nullable()->constrained('unions')->onDelete('set null');
            $table->string('holding_village')->nullable();
            $table->string('referral_id')->nullable();
            $table->string('placement_user_id')->nullable();
            $table->string('nominee_name')->nullable();
            $table->string('relationship')->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('bookings');
    }
};
