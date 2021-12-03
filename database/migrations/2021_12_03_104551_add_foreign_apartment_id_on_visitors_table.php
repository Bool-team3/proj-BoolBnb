<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignApartmentIdOnVisitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('visitors', function (Blueprint $table) {

            $table->unsignedBigInteger('apartment_id')->after('id')->nullable();

            $table->foreign('apartment_id')->references('id')->on('apartments')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('visitors', function (Blueprint $table) {
            $table->dropForeign('visitors_apartment_id_foreign');      
            
            $table->dropColumn('apartment_id');
        });
    }
}
