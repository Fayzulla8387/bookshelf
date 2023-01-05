<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use App\Category;
use App\Author;
use App\Publisher;
use App\Book;
//use App\User;
use App\BookAuthor;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{

    public function profile($username)
    {
    	$user = User::where('username', $username)->first();
    	
    	if (!is_null($user)) {
            $books = $user->books()->paginate(10);
    		return view('frontend.pages.users.show', compact('user', 'books'));
    	}
    	return redirect()->route('index');
    }   
  
}
