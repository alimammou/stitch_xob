<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointspurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pointspurchases', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('invoiceid');
            $table->string('invoiceconfirmed');
            $table->string('amount_in_usd');
            $table->string('status');
            $table->string('rate');
            $table->string('delivery_id');
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
        Schema::dropIfExists('pointspurchases');
    }
}
