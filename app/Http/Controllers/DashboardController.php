<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $username = Auth::user()->username;
//dd($username);
        $users = User::where('username', $username)->first();
//        dd($users);

        if (!is_null($users)) {
            return view('frontend.pages.users.dashboard', compact('users'));

        }
        return redirect()->route('index');
    }

    public function books()
    {
        $users=Auth::user();
        if (!is_null($users)) {
            $books = $users->books()->paginate(10);
            return view('frontend.pages.users.dashboard_books', compact('users', 'books'));

        }
        return redirect()->route('index');
    }

}