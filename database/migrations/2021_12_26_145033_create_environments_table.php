<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnvironmentsTable extends Migration
{
    public function up()
    {
        Schema::create('environments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('target_id')->index();
            $table->string('slug');
            $table->string('name');
            $table->string('color')->nullable();
            $table->string('url')->nullable();
            $table->json('variables')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->unique(['target_id', 'name']);
        });
    }
}
