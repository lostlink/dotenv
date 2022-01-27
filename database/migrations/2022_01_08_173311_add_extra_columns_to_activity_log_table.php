<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('activity_log', function (Blueprint $table) {
            $table->boolean('succeeded')->after('team_id')->default(true);
            $table->string('trigger')->after('succeeded')->default('WEB');
        });
    }
};
