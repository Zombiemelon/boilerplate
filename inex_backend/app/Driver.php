<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    /**
     * @return iterable
     */
    public function getAllDrivers() :iterable
    {
        $drivers = self::all();
        return $drivers;
    }
}
