<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreitemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('storeitems', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->text('description');
            $table->string('pathtothumbnail')->nullable();
            $table->string('platforms_id');
            $table->text('genres');
            $table->string('developer');
            $table->string('publisher');
            $table->text('trailer');
            $table->string('price');
            $table->string('redeemableon');
            $table->string('num')->default(0);
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
        Schema::dropIfExists('storeitem');
    }
}
