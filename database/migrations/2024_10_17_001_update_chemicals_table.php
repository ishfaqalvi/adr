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
        Schema::table('chemicals', function (Blueprint $table) {
            $table->text('name_sp')->nullable()->after('name_it');
            $table->text('name_sw')->nullable()->after('name_it');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chemicals', function (Blueprint $table) {
            $table->dropColumn('name_sp');
            $table->dropColumn('name_sw');
        });
    }
};
