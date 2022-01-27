<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Team::class)->index()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\User::class)->index()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Project::class)->index()->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Target::class)->index()->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Environment::class)->index()->nullable()->constrained()->cascadeOnDelete();
            $table->string('transaction');
            $table->string('status');
            $table->string('reason')->nullable();
            $table->json('team_model');
            $table->json('user_model');
            $table->json('project_model')->nullable();
            $table->json('target_model')->nullable();
            $table->json('environment_model')->nullable();
            $table->text('current')->nullable();
            $table->text('original')->nullable();
            $table->timestamps();
        });
    }
};
