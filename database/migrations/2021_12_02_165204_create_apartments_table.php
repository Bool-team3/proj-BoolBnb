<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->tinyInteger('room')->unsigned();
            $table->tinyInteger('bedroom')->unsigned();
            $table->tinyInteger('bathroom')->unsigned();
            $table->tinyInteger('bed')->unsigned();
            $table->smallInteger('mq')->unsigned();
            $table->text('img_url')->nullable();
            $table->boolean('visible');
            $table->string('street_name');
            $table->string('street_number');
            $table->string('province')->nullable();
            $table->string('postal_code', 5);
            $table->text('lat');
            $table->text('lot');

             //soft delete for apartments
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apartments');
    }
}
