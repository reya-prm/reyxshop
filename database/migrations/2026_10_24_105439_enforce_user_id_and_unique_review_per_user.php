<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Remove legacy reviews where user_id is NULL (pre-auth data)
        // Safe since Phase 1 just finished; these are test/demo entries
        DB::table('reviews')->whereNull('user_id')->delete();

        // Remove legacy questions where user_id is NULL
        DB::table('product_questions')->whereNull('user_id')->delete();

        // Now enforce user_id NOT NULL for reviews
        Schema::table('reviews', function (Blueprint $table) {
            // Drop existing foreign key that allows SET NULL
            $table->dropForeign(['user_id']);

            // Change user_id to NOT NULL
            $table->foreignId('user_id')->nullable(false)->change();

            // Re-add foreign key with cascadeOnDelete
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();

            // Add unique constraint: one review per user per product
            $table->unique(['product_id', 'user_id'], 'reviews_product_user_unique');
        });

        // Enforce user_id NOT NULL for product_questions
        Schema::table('product_questions', function (Blueprint $table) {
            // Drop existing foreign key that allows SET NULL
            $table->dropForeign(['user_id']);

            // Change user_id to NOT NULL
            $table->foreignId('user_id')->nullable(false)->change();

            // Re-add foreign key with cascadeOnDelete
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop unique constraint
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropUnique('reviews_product_user_unique');

            // Drop foreign key
            $table->dropForeign(['user_id']);

            // Revert to nullable
            $table->foreignId('user_id')->nullable()->change();

            // Re-add foreign key with nullOnDelete
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
        });

        // Revert user_id to nullable for product_questions
        Schema::table('product_questions', function (Blueprint $table) {
            // Drop foreign key
            $table->dropForeign(['user_id']);

            // Revert to nullable
            $table->foreignId('user_id')->nullable()->change();

            // Re-add foreign key with nullOnDelete
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
        });
    }
};
