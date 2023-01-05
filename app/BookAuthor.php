<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookAuthor extends Model
{
    public function book()
    {
    	return $this->belongsTo(Book::class);
    }    

    public function author()
    {
    	return $this->belongsTo(Author::class);
    }
    
}
