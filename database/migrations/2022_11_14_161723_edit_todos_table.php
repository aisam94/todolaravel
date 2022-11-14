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
        // add column here
        Schema::table('todos', function (Blueprint $table) {
            $table->string('etc')->default('none');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // drop column here
        Schema::table('todos', function (Blueprint $table) {
            // $table->dropColumn('etc');
        });
    }
};
