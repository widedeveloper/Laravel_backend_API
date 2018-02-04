<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Radio extends Model
{
    
    public function scopeSearch($query, $s) {
        return $query->where('radios.name','like', '%'.$s.'%');
    }
}

