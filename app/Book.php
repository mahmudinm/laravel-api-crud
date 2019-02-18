<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
		protected $table = 'books';
    protected $fillable = ['category_id', 'author_id', 'nama', 'harga', 'gambar'];

    public function author()
    {
        return $this->belongsTo('App\Author');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
