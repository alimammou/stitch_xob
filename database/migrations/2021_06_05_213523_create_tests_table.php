<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('title')->unique();
            $table->text('description');
            $table->string('pathtothumbnail')->nullable();
            $table->string('platforms_id');
            $table->string('genres');
            $table->text('trailer');
            $table->string('page_status');
            $table->string('tester_registration');
            $table->string('rewardpool');
            $table->string('remaining_points');
            $table->string('version');
            $table->string('test_status');
            $table->softDeletes();
            $table->string('pathtosc1')->nullable();
            $table->string('pathtosc2')->nullable();
            $table->string('pathtosc3')->nullable();
            $table->string('pathtosc4')->nullable();
            $table->string('pathtosc5')->nullable();
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
        Schema::dropIfExists('tests');
    }
}
