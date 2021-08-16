<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Gamecodes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gamecodes', function (Blueprint $table) {
            $table->id();
            $table->string('tests_id');
            $table->string('code');
            $table->string('testapp_id')->nullable();
            $table->timestamps();
            $table->timestamp('sent_on')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
