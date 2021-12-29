<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration
{
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->index();
            $table->foreignId('user_id')->index();
            $table->foreignId('project_id')->index()->nullable();
            $table->foreignId('target_id')->index()->nullable();
            $table->foreignId('environment_id')->index()->nullable();
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
}
