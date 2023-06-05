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
        Schema::create('dokuments', function (Blueprint $table) {
            $table->id();
            $table->string('image', 225)->nullable();
            $table->unsignedBigInteger('kriterias_id');
            $table->foreign('kriterias_id')->references('id')->on('kriterias')->onDelete('restrict');
            $table->unsignedBigInteger('subs_id');
            $table->foreign('subs_id')->references('id')->on('subs')->onDelete('restrict');
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
        Schema::dropIfExists('dokuments');
    }
};
