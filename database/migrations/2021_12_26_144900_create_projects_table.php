<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->index();
            $table->string('slug');
            $table->string('name');
            $table->json('variables')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }
}
