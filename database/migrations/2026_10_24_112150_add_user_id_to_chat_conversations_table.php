<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('chat_conversations', function (Blueprint $table) {
            // Add user_id foreign key for authenticated customers
            $table->foreignId('user_id')->nullable()->after('id')->constrained('users')->cascadeOnDelete();
            
            // Drop guest_token index first if SQLite
            try {
                if (DB::getDriverName() === 'sqlite') {
                    DB::statement('DROP INDEX IF EXISTS chat_conversations_guest_token_index');
                }
            } catch (\Throwable $e) {}

            // Drop guest identification columns
            if (Schema::hasColumn('chat_conversations', 'guest_token')) {
                $table->dropColumn('guest_token');
            }
            if (Schema::hasColumn('chat_conversations', 'customer_name')) {
                $table->dropColumn('customer_name');
            }
            
            // Ensure each customer has at most one conversation
            $table->unique(['user_id'], 'chat_conversations_user_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chat_conversations', function (Blueprint $table) {
            // Drop unique constraint
            $table->dropUnique('chat_conversations_user_unique');
            
            // Restore guest columns
            $table->string('guest_token')->nullable()->index();
            $table->string('customer_name')->nullable();
            
            // Drop user_id foreign key and column
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
