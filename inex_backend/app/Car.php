<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    /**
     * @return iterable
     */
    public function getAllCars() :iterable
    {
        $cars = self::all();
        return $cars;
    }
}
