<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table)
        {
            $table->id();

            $table->bigInteger('player_id')->unsigned()->index();
            $table->foreign('player_id')->references('id')->on('players')->onDelete('CASCADE');

            $table->text('street', 100);
            $table->text('city', 100);
            $table->text('state', 2);
            $table->text('zip', 5);

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
        Schema::dropIfExists('addresses');
    }
}
