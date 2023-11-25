<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBookingsTable extends Migration
{
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->unsignedInteger('ride_id');
            $table->foreign('ride_id', 'ride_fk_1918935')->references('id')->on('rides');
             $table->unsignedInteger('client_id');
            $table->foreign('client_id', 'client_fk_1918935')->references('id')->on('users');
        });
    }
}
