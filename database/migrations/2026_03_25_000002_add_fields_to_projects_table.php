<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('tagline')->nullable()->after('title');
            $table->string('category')->nullable()->after('tagline');
            $table->date('launch_date')->nullable()->after('status');
            $table->unsignedInteger('votes')->default(0)->after('progress');
            $table->boolean('featured')->default(false)->after('votes');
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['tagline', 'category', 'launch_date', 'votes', 'featured']);
        });
    }
};
