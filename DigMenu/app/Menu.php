<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus';
    public $primaryKey = 'id';
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function images()
    {
        return $this->HasMany('App\MenuImage');
    }
}
