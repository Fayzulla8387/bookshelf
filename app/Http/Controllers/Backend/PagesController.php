<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Book;
use App\Category;
use App\Author;
use App\Publisher;

class PagesController extends Controller
{
	function __construct()
	{
		$this->middleware('auth');
	}

    public function index()
    {
    	$total_books = count(Book::all());
    	$total_authors = count(Author::all());
    	$total_publishers = count(Publisher::all());
    	$total_categories = count(Category::all());
    	return view('backend.pages.index', compact('total_books', 'total_authors', 'total_publishers', 'total_categories'));
    }
}
