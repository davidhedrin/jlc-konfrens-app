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
        Schema::table('users', function (Blueprint $table) {
            $table->bigInteger('jemaat_id')->unsigned();
            $table->bigInteger('jabatan_id')->unsigned();
            $table->foreign('jemaat_id')->references('id')->on('jemaats')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('jabatan_id')->references('id')->on('jabatans')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['jemaat_id', 'jabatan_id']);
        });
    }
};
