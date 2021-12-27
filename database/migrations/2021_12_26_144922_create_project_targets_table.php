<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectTargetsTable extends Migration
{
    public function up()
    {
        Schema::create('project_targets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->index();
            $table->string('slug');
            $table->string('name');
            $table->text('variables')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }
}
