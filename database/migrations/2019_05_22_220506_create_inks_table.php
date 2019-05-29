<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_slug');
//            $table->text('text')->nullable();
//            $table->text('images')->nullable();
//            $table->text('videos')->nullable();
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
        Schema::dropIfExists('inks');
    }
}
