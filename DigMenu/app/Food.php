<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $table = 'food';
    public $primaryKey = 'id';
    public $timestamps = true;
}
