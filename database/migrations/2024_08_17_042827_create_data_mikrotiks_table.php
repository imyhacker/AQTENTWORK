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
        Schema::create('datamikrotik', function (Blueprint $table) {
            $table->id();
            $table->string('ipmikrotik')->required();
            $table->string('usernamemikrotik')->required();
            $table->string('passwordmikrotik')->required();
            $table->integer('portmikrotik')->required();
            $table->string('catatan')->required();
            $table->string('slugcatatan')->required();
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
        Schema::dropIfExists('datamikrotik');
    }
};
