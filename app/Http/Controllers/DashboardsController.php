<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Book;
use App\Publisher;
use App\Category;
use App\BookAuthor;
use App\Author;
use App\BookRequest;
use Auth;

class DashboardsController extends Controller
{
	function __construct()
	{
		$this->middleware('auth');
	}

    public function index()
    {
    	$user = Auth::user();
    	if (!is_null($user)) {
    		return view('frontend.pages.users.dashboard', compact('user'));
    	}
    	return redirect()->route('index');
    }    

   public function books()
    {
    	$user = Auth::user();
    	
    	if (!is_null($user)) {
            $books = $user->books()->paginate(10);
    		return view('frontend.pages.users.dashboard_books', compact('user', 'books'));
    	}
    	return redirect()->route('index');
    }


   public function requestBookList()
    {
        $user = Auth::user();
        
        if (!is_null($user)) {
            $book_requests = BookRequest::where('owner_id', $user->id)->orderBy('id', 'desc')->paginate(20);

            return view('frontend.pages.users.request_books', compact('user', 'book_requests'));
        }
        return redirect()->route('index');
    }

    
   public function orderBookList()
    {
        $user = Auth::user();
        
        if (!is_null($user)) {
            $book_orders = BookRequest::where('user_id', $user->id)->orderBy('id', 'desc')->paginate(20);

            return view('frontend.pages.users.order_books', compact('user', 'book_orders'));
        }
        return redirect()->route('index');
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function bookEdit($slug)
    {
        $book = Book::where('slug', $slug)->first();

        $categories = Category::all();
        $publishers = Publisher::all();
        $authors = Author::all();
        $books = Book::where('is_approved', 1)->where('slug', '!=', $slug)->get();
        return view('frontend.pages.users.edit_book', compact('categories', 'publishers', 'authors', 'books', 'book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function bookUpdate(Request $request, $slug)
    {
       $book = Book::where('slug', $slug)->first();

       $request->validate([
            'title' => 'required|max:50',
            'category_id' => 'required',
            'publisher_id' => 'required',
            'slug' => 'nullable|unique:books,slug,'.$book->id,
            'description' => 'nullable',
            'image' => 'nullable|image|max:2048'
        ],
        [
            'title.required' => 'Please give book title',
            'image.max' => 'Image size can not be greater than 2MB'
        ]);

        
        $book->title = $request->title;
        if (empty($request->slug)) {
            $book->slug = str_slug($request->title);
        }else{
            $book->slug = $request->slug;
        }
        
        $book->category_id = $request->category_id;
        $book->publisher_id = $request->publisher_id;
        $book->publish_year = $request->publish_year;
        $book->description = $request->description;
        // $book->user_id = 1;
        // $book->is_approved = 1;
        $book->isbn = $request->isbn;
        $book->quantity = $request->quantity;
        $book->translator_id = $request->translator_id;
        $book->save();

        // Image Upload
        if ($request->image) {

            // Delete Old Image
            if (!is_null($book->image)) {
                $file_path = "images/books/".$book->image;
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }
            
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $name = time().'-'.$book->id.'.'.$ext;
            $path = "images/books";
            $file->move($path, $name);
            $book->image = $name;
            $book->save();
        }

        // Book Authors
        
        // Delete old authors table data
        $book_authors = BookAuthor::where('book_id', $book->id)->get();
        foreach ($book_authors as $author) {
            $author->delete();
        }

        foreach ($request->author_ids as $id) {
            $book_author = new BookAuthor();
            $book_author->book_id = $book->id;
            $book_author->author_id = $id;
            $book_author->save();
        }
        
        session()->flash('success', 'Book has been updated !!');
        return redirect()->route('users.dashboard.books');
    }


    public function requestBook(Request $request, $slug)
    {
       $book = Book::where('slug', $slug)->first();

       $request->validate([
            'user_message' => 'required|max:300'
        ],
        [
            'user_message.required' => 'Please write your message to request for the book !!'
        ]);

        if (!is_null($book)) {
           $book_request = new BookRequest();
           $book_request->book_id = $book->id;
           $book_request->user_id = Auth::id();
           $book_request->owner_id = $book->user_id;
           $book_request->status = 1;
           $book_request->user_message = $request->user_message;
           $book_request->save();
            
            session()->flash('success', 'Book has been requested to the user !!');
            return back();
        }else{
            session()->flash('error', 'No book found !!');
            return back();
        }
    }

    public function requestBookUpdate(Request $request, $request_id)
    {

       $book_request = BookRequest::find($request_id);

       $request->validate([
            'user_message' => 'required|max:300'
        ],
        [
            'user_message.required' => 'Please write your message to request for the book !!'
        ]);

        if (!is_null($book_request)) {
           $book_request->user_message = $request->user_message;
           $book_request->save();
            
            session()->flash('success', 'Book request has been updated and sent to the user !!');
            return back();
        }else{
            session()->flash('error', 'No book found !!');
            return back();
        }
    }

    public function requestBookApprove(Request $request, $request_id)
    {

       $book_request = BookRequest::find($request_id);

        if (!is_null($book_request)) {
           $book_request->status = 2; // Confirmed by owner
           $book_request->save();
            
            session()->flash('success', 'Book request has been approved and sent to the user !!');
            return back();
        }else{
            session()->flash('error', 'No book found !!');
            return back();
        }
    }


    public function requestBookReject(Request $request, $request_id)
    {

       $book_request = BookRequest::find($request_id);

        if (!is_null($book_request)) {
           $book_request->status = 3; // Rejected by owner
           $book_request->save();
            
            session()->flash('success', 'Book request has been rejected and sent to the user !!');
            return back();
        }else{
            session()->flash('error', 'No book found !!');
            return back();
        }
    }


    public function orderBookApprove(Request $request, $request_id)
    {

       $book_request = BookRequest::find($request_id);

        if (!is_null($book_request)) {
           $book_request->status = 4; // Confirmed by user
           $book_request->save();

           $book = Book::find($book_request->book_id);
           $book->decrement('quantity');
            
            session()->flash('success', 'Book order has been confirmd !!');
            return back();
        }else{
            session()->flash('error', 'No book found !!');
            return back();
        }
    }

    public function orderBookReturn(Request $request, $request_id)
    {

       $book_request = BookRequest::find($request_id);

        if (!is_null($book_request)) {
           $book_request->status = 6; //Return by user
           $book_request->save();
            
            session()->flash('success', 'Book order has been returned !!');
            return back();
        }else{
            session()->flash('error', 'No book found !!');
            return back();
        }
    }

    public function orderBookReturnConfirm(Request $request, $request_id)
    {

       $book_request = BookRequest::find($request_id);

        if (!is_null($book_request)) {
           $book_request->status = 7; //Return confirmed by owner
           $book_request->save();

           $book = Book::find($book_request->book_id);
           $book->increment('quantity');
            
            session()->flash('success', 'Book order has been returned successfully !!');
            return back();
        }else{
            session()->flash('error', 'No book found !!');
            return back();
        }
    }


    public function orderBookReject(Request $request, $request_id)
    {

       $book_request = BookRequest::find($request_id);

        if (!is_null($book_request)) {
           $book_request->status = 5; // Rejected by user
           $book_request->save();
            
            session()->flash('success', 'Book order has been rejected !!');
            return back();
        }else{
            session()->flash('error', 'No book found !!');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function bookDelete($id)
    {
        // Delete all child categories
        $book = Book::find($id);
        if (!is_null($book)) {
            // Delete Old Image
            if (!is_null($book->image)) {
                $file_path = "images/books/".$book->image;
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }

            $book_authors = BookAuthor::where('book_id', $book->id)->get();
            foreach ($book_authors as $author) {
                $author->delete();
            }

            $book->delete();
        }


        session()->flash('success', 'Book has been deleted !!');
        return back();
    } 

    public function requestBookDelete($id)
    {
        $book_request = BookRequest::find($id);

        if (!is_null($book_request)) {
            $book_request->delete();
        }

        session()->flash('success', 'Book request has been canceled !!');
        return back();
    }

}
