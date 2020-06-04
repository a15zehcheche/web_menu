<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuImage extends Model
{
    protected $table = 'menu_image';
    public $primaryKey = 'id';
    public $timestamps = true;
    
    public function menu()
    {
        return $this->belongsTo('App\Menu');
    }
}
