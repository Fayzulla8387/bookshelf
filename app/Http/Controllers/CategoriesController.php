<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use App\Book;

class CategoriesController extends Controller
{
    public function show($slug)
    {
    	$category = Category::where('slug', $slug)->first();
    	if (!is_null($category)) {
    		$books = $category->books()->orderBy('id', 'desc')->paginate(20);
    		return view('frontend.pages.books.index', compact('category', 'books'));
    	}
    	return redirect()->route('index');
    }
}
