<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_submissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('form_id');
            $table->string('user_id');
            $table->string('tests_id');
            $table->string('testapp_id');
            $table->text('content');
            $table->string('status')->nullable();
            $table->string('score')->nullable();
            $table->string('review')->nullable();
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
        Schema::dropIfExists('forms_submisiions');
    }
}
