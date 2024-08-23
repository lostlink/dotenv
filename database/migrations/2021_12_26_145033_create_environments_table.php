<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('environments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(App\Models\Target::class)->index()->constrained()->cascadeOnDelete();
            $table->integer('parent_id')->index()->nullable();
            $table->string('slug');
            $table->string('name');
            $table->string('color')->nullable();
            $table->string('url')->nullable();
            $table->text('variables')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->unique(['target_id', 'parent_id', 'name']);
        });
    }
};
