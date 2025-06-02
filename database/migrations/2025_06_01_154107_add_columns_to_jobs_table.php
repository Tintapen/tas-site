<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->integer('vacancy')->default(1);
            $table->string('job_nature')->nullable();
            $table->string('job_type')->nullable();
            $table->string('salary')->nullable();
            $table->date('application_deadline')->nullable();
            $table->string('slug')->unique();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropColumn([
                'vacancy',
                'job_nature',
                'job_type',
                'salary',
                'application_deadline',
                'slug',
            ]);
        });
    }
};
