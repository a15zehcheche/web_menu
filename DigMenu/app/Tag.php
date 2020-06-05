<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tag';
    public $primaryKey = 'id';
    public $timestamps = true;

    public function menus()
    {
        return $this->HasMany('App\menus');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
