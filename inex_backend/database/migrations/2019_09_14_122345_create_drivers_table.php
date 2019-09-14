<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('surname');
            $table->string('name_english');
            $table->string('surname_english');
            $table->string('passport_number');
            $table->timestamps();
        });

        DB::table('drivers')->insert(
            array(
                array('name' => 'Виктор',
                    'surname' => 'Постовой',
                    'name_english' => 'Victor',
                    'surname_english' => 'Postovoi',
                    'passport_number' => 'AA 1279262'),
                array('name' => 'Александру',
                    'surname' => 'Урсу',
                    'name_english' => 'Alexandru',
                    'surname_english' => 'Ursu',
                    'passport_number' => 'АВ 0483058'),
                array('name' => 'Иван',
                    'surname' => 'Суручеану',
                    'name_english' => 'Ivan',
                    'surname_english' => 'Suruceanu',
                    'passport_number' => 'AA 0800375'),
                array('name' => 'Васил',
                    'surname' => 'Падурару',
                    'name_english' => 'Vasile',
                    'surname_english' => 'Paduraru',
                    'passport_number' => '56899505'),
                array('name' => 'Андрей',
                    'surname' => 'Чиореску',
                    'name_english' => 'Andrei',
                    'surname_english' => 'Ciorescu',
                    'passport_number' => 'АВ 0520302'),
                array('name' => 'Виктор',
                    'surname' => 'Суручеану мл.',
                    'name_english' => 'Victor',
                    'surname_english' => 'Suruceanu',
                    'passport_number' => 'AA 1488363'),
                array('name' => 'Виктор',
                    'surname' => 'Суручеану ст.',
                    'name_english' => 'Victor',
                    'surname_english' => 'Suruceanu',
                    'passport_number' => 'АВ 0381751')
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
        Schema::dropIfExists('drivers');
    }
}
