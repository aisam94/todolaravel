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

    // called when run migrate(add new tables, column, indexes to db)
    public function up()
    {
        Schema::create('todos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name'); // add name
            $table->text('description'); // add description
            $table->boolean('isDeleted')->default(false); // for soft delete
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */

    //  called when run rollback(reverse operations performed by up method)
    public function down()
    {
        Schema::dropIfExists('todos');
    }
};
