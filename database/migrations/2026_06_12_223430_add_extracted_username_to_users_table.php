<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Step 1: Add the column as nullable first so existing rows don't crash
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->nullable()->after('name');
            $table->boolean('must_change_password')->default(false)->after('is_active');
        });

        // Step 2: Chunk through existing users and extract username from email
        DB::table('users')->orderBy('id')->chunk(100, function ($users) {
            foreach ($users as $user) {
                // Extracts everything before the '@' symbol
                $extractedUsername = Str::before($user->email, '@');

                // Fallback check: Ensure it's unique in case two emails have the same prefix
                $finalUsername = $extractedUsername;
                $counter = 1;
                while (DB::table('users')->where('username', $finalUsername)->exists()) {
                    $finalUsername = $extractedUsername . $counter;
                    $counter++;
                }

                // Update the user record
                DB::table('users')
                    ->where('id', $user->id)
                    ->update(['username' => $finalUsername]);
            }
        });

        // Step 3: Now that all data is populated, enforce NOT NULL and UNIQUE constraints
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->nullable(false)->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username');
        });
    }
};
