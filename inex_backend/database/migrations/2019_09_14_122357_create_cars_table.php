<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('plate_number');
            $table->timestamps();
        });

        DB::table('cars')->insert(
            array(
                array('plate_number' => 'NT-11-BKM / NT-12-BKM'),
                array('plate_number' => 'NT-20-BKM / B-144-GTS'),
                array('plate_number' => 'NT-40-BKM / NT-41-BKM'),
                array('plate_number' => 'NT-30-BKM / NT-31-BKM')
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
}
