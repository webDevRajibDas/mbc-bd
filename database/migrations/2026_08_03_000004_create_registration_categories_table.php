<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('registration_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique();
            $table->string('slug', 120)->unique();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        DB::table('registration_categories')->insert(collect(['Officer', 'Customer', 'Agent', 'Merchant'])->map(fn ($name) => [
            'name' => $name, 'slug' => strtolower($name), 'is_active' => true, 'created_at' => now(), 'updated_at' => now(),
        ])->all());
    }

    public function down(): void { Schema::dropIfExists('registration_categories'); }
};
