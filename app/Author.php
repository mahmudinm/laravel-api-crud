<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = ['nama', 'jenis_kelamin'];
    
    public function books()
    {
        return $this->hasMany('App\Book');
    }
}
