<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtraColumnsToActivityLogTable extends Migration
{
    public function up()
    {
        Schema::table('activity_log', function (Blueprint $table) {
            $table->boolean('succeeded')->after('team_id')->default(true);
            $table->string('trigger')->after('succeeded');
        });
    }
}
