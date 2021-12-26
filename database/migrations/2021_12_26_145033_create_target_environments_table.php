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
            $table->foreignId('target_id')->index();
            $table->string('name');
            $table->json('variables');
            $table->timestamps();
        });
    }
}
