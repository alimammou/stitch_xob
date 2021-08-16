<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Bugreports extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bugreports', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('tests_id');
            $table->string('testapp_id');
            $table->string('title');
            $table->text('bug');
            $table->text('stepsto');
            $table->string('status')->nullable();
            $table->string('score')->nullable();
            $table->timestamp('reviewed_at')->nullable();
            $table->string('reward')->nullable();
            $table->timestamps();
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
