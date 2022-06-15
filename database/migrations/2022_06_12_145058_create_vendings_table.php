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
    protected $table = 'vendings';
    public function up()
    {
        Schema::create('vending', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('商品名',100);
            $table->string('画像');
            $table->string('価格');
            $table->string('在庫数');
            $table->text('メーカー名');
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
        Schema::dropIfExists('vendings');
    }
};
