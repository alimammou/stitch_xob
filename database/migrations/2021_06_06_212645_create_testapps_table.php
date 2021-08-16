<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestappsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('testapps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('tests_id');
            $table->boolean('approved')->default(false);
            $table->timestamp('invited_on')->nullable();
            $table->text('nda_text')->nullable();
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
        Schema::dropIfExists('testapps');
    }
}
