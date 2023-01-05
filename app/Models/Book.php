<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $table='books';
    public function categories(){
        return $this->belongsTo(Category::class,'category_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function publishers(){
        return $this->belongsTo(Publisher::class,'publisher_id');
    }

    /**
     * @param $book_id
     * @param $author_id
     * @return bool
     */
    public static function isAuthorSelected($book_id,$author_id){
$bool_author=BookAuthor::where('book_id',$book_id)->where('author_id',$author_id)->first();
if(!is_null($bool_author)){
    return true;
}else {
    return false;
}
    }
}
