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
        Schema::create('issues', function (Blueprint $table) {
            $table->id();
            $table->string('subject');
            $table->foreignId('project_id')
                ->constrained('projects')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('priority_id')
                ->constrained('priorities')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('status_id')
                ->constrained('statuses')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('issues');
    }
};
