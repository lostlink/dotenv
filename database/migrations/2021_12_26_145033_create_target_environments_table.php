<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTargetEnvironmentsTable extends Migration
{
    public function up()
    {
        Schema::create('target_environments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_target_id')->index();
            $table->string('slug');
            $table->string('name');
            $table->text('variables')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }
}
