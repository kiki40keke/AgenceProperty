<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            // Place the first new column right after the 'id' column
            $table->string('title')->after('id')->nullable();

            // Position each subsequent column after the previous one to keep order
            $table->text('description')->nullable()->after('title');
            $table->integer('surface')->nullable()->after('description');
            $table->integer('rooms')->nullable()->after('surface');
            $table->integer('bedrooms')->nullable()->after('rooms');
            $table->integer('floor')->nullable()->after('bedrooms');
            $table->integer('price')->nullable()->after('floor');
            $table->string('address')->nullable()->after('price');
            $table->string('city')->nullable()->after('address');
            $table->string('postal_code')->nullable()->after('city');

            // Add 'sold' with a default of false and place it after 'postal_code'
            // It's safe to add as NOT NULL because a default is provided
            $table->boolean('sold')->default(false)->after('postal_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            // Drop the columns we added in up()
            $table->dropColumn([
                'title',
                'description',
                'surface',
                'rooms',
                'bedrooms',
                'floor',
                'price',
                'address',
                'city',
                'postal_code',
                'sold',
            ]);
        });
    }
};
