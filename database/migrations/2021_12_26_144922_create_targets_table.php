<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTargetsTable extends Migration
{
    public function up()
    {
        Schema::create('targets', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Project::class)->index()->constrained()->cascadeOnDelete();
            $table->string('slug');
            $table->string('name');
            $table->string('color')->nullable();
            $table->text('variables')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->unique(['project_id', 'name']);
        });
    }
}
