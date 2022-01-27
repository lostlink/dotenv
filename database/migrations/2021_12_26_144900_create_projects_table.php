<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Team::class)->index()->constrained()->cascadeOnDelete();
            $table->string('slug');
            $table->string('name');
            $table->text('variables')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();

            $table->unique(['team_id', 'name']);
        });
    }
};
