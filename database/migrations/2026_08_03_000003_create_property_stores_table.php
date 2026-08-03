<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('property_stores', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('title_bn')->nullable();
            $table->foreignId('property_category_id')->nullable()->constrained()->nullOnDelete();
            $table->string('community_type')->nullable();
            $table->string('reference_code')->nullable()->unique();
            $table->text('short_description')->nullable();
            $table->longText('description_bn')->nullable();
            $table->foreignId('division_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('district_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('upazila_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('union_id')->nullable()->constrained()->nullOnDelete();
            $table->string('landmark')->nullable();
            $table->decimal('minimum_plot_size', 10, 2)->nullable();
            $table->string('plot_unit', 30)->nullable();
            $table->unsignedInteger('total_plots')->nullable();
            $table->unsignedInteger('members_target')->nullable();
            $table->decimal('booking_money', 14, 2)->nullable();
            $table->unsignedInteger('installment_duration')->nullable();
            $table->string('duration_unit', 20)->nullable();
            $table->json('installments')->nullable();
            $table->string('entry_designation')->nullable();
            $table->string('top_designation')->nullable();
            $table->string('promotion_path')->nullable();
            $table->string('feature_image')->nullable();
            $table->json('gallery_images')->nullable();
            $table->enum('status', ['active', 'upcoming', 'sold_out', 'draft'])->default('draft');
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_members_only')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void { Schema::dropIfExists('property_stores'); }
};
