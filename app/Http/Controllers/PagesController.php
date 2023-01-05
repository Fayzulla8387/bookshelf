<?php

namespace App\Http\Controllers;

use App\Book;
use App\Category;
use App\Publisher;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
    	$categories = Category::all();
    	$publishers = Publisher::all();
    	$books = Book::where('is_approved', 1)->orderBy('id', 'desc')->paginate(10);
        return view('frontend.pages.index', compact('books', 'publishers', 'categories'));
    }
}
