<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropActivitiesTable extends Migration
{
    public function up()
    {
        Schema::dropIfExists('activities');
    }
}
