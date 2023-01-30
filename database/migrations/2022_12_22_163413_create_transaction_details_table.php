<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('transaction_id')->unsigned();
            $table->foreign('transaction_id')->nullable()->references('id')->on('transactions')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->bigInteger('item_id')->unsigned();
            $table->foreign('item_id')->nullable()->references('id')->on('items')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->integer('qty')->unsigned();
            $table->integer('subtotal');
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
        Schema::dropIfExists('transaction_details');
    }
};
