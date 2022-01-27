<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('url')->nullable()->after('name');
        });

        Schema::table('targets', function (Blueprint $table) {
            $table->string('url')->nullable()->after('name');
        });
    }
};
