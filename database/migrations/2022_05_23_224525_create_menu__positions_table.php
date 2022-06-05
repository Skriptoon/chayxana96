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
        Schema::create('menu__positions', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('id_category');
            $table->string('name', 63);
            $table->string('img', 63);
            $table->string('desc');
            $table->integer('price');
            $table->boolean('main_page');
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
        Schema::dropIfExists('menu__positions');
    }
};
