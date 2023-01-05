<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function parent_category($parent_id)
    {
    	$category = Category::find($parent_id);
    	return $category;
    }

    public function books()
    {
    	return $this->hasMany(Book::class);
    }
}
