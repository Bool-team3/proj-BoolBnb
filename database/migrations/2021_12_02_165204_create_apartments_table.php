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
            $table->string('city');
            $table->string('street_name', 50);
            $table->string('street_number', 10);
            $table->string('province')->nullable();
            $table->string('postal_code', 5);
            $table->string('lat');
            $table->string('lon');

             //soft delete for apartments
            $table->softDeletes();

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
        Schema::dropIfExists('apartments');
    }
}
