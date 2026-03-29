<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Convert any early_adopter records to tester
        // SQLite doesn't enforce enum values so no column ALTER needed
        DB::table('project_followers')
            ->where('role', 'early_adopter')
            ->update(['role' => 'tester']);
    }

    public function down(): void
    {
        // Nothing to reverse - early_adopter data is gone
    }
};
