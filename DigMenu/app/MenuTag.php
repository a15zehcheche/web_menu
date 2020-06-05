<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuTag extends Model
{
    protected $table = 'menu_tag';
    public $primaryKey = 'id';
    public $timestamps = true;
    
    public function tag()
    {
        return $this->belongsTo('App\Tag');
    }
}
