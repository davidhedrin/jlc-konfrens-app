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
        Schema::table('fixed_assets', function (Blueprint $table) {
            $table->string('sertifikat_file')->nullable();
            $table->string('imb_file')->nullable();
            $table->string('history_file')->nullable();
            $table->string('doc_kerjasama')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fixed_assets', function (Blueprint $table) {
            $table->dropColumn([
                'sertifikat_file', 'imb_file', 'history_file', 'doc_kerjasama'
            ]);
        });
    }
};
