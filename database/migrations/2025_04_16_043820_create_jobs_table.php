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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->char('isactive', 1)->default('Y');
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->string('title_id', 100);
            $table->string('title_en', 100);
            $table->text('description_id');
            $table->text('description_en');
            $table->string('location', 60);
            $table->foreignId('department_id')->constrained()->onDelete('cascade');
            $table->date('expired_at')->nullable();
            $table->char('isexpired', 1)->default('N');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
