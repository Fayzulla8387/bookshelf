<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use App\Models\BookAuthor;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books=Book::all();




        return  view('backend.pages.books.index',compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::all();
//dd($categories);
        $publishers=Publisher::all();
        $authors=Author::all();
        $books=Book::where('is_approved',1)->get();


        return  view('backend.pages.books.create',compact('categories','publishers','authors','books'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request);
        $request->validate([
            'title'=>'required|max:50',
            'category_id'=>'required',
            'publisher_id'=>'required',
            'slug'=>'nullable|unique:books',
            'description'=>'required',
            'image'=>'required|image|max:2048'
        ]);
        $books=new Book();
$books->title=$request->title;
if(empty($request->slug)){
    $books->slug=str_slug($request->title);
}else {
    $books->slug=$request->slug;
}
$books->category_id=$request->category_id;
$books->publisher_id=$request->publisher_id;
$books->publish_year=$request->publish_year;
$books->description=$request->description;
$books->is_approved=1;
$books->user_id=1;
$books->isbn=$request->isbn;
$books->translator_id=$request->translator_id;
        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/images/books/'), $filename);
            $books['image'] = $filename;
        }
//        dd($books);
        $books->save();
        foreach ($request->author_ids as $id){
            $book_author=new BookAuthor();
            $book_author->book_id=$books->id;
            $book_author->author_id=$id;
            $book_author->save();
        }

session()->flash('success','Book muvaffqatli yaratildi');
return redirect(route('admin.book.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book=Book::find($id);
//        dd($book->image);
//$id=$book->id;
        $categories=Category::all();

        $publishers=Publisher::all();
        $authors=Author::all();
        $books=Book::where('is_approved',1)->where('id','!=',$id)->get();
//        dd($books)
        return  view('backend.pages.books.edit',compact('categories','publishers','authors','books','book'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $books= Book::find($id);
        $request->validate([
            'title'=>'required|max:50',
            'category_id'=>'required',
            'publisher_id'=>'required',
            'slug'=>'nullable|unique:books,slug,'.$books->id,
            'description'=>'nullable',
            'image'=>'nullable|image|max:2048'
        ]);

        $books->title=$request->title;
        if(empty($request->slug)){
            $books->slug=str_slug($request->title);
        }else {
            $books->slug=$request->slug;
        }
        $books->category_id=$request->category_id;
        $books->publisher_id=$request->publisher_id;
        $books->publish_year=$request->publish_year;
        $books->description=$request->description;
        $books->is_approved=1;
        $books->isbn=$request->isbn;
        $books->translator_id=$request->translator_id;
        if($request->hasFile('image')){
            $img=public_path('assets/images/books/').$books->image;
            if(\Illuminate\Support\Facades\File::exists($img)){
                File::delete($img);
            }

            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/images/books/'), $filename);
            $books['image'] = $filename;

        }
        $books->save();
        $bool_author=BookAuthor::where('book_id',$books->id)->get();
        foreach ($bool_author as $author)
        {
            $author->delete();
        }
        foreach ($request->author_ids as $id){
            $book_author=new BookAuthor();
            $book_author->book_id=$books->id;
            $book_author->author_id=$id;
            $book_author->save();
        }

        session()->flash('success','Book muvaffqatli tahrirlandi');
        return redirect(route('admin.book.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $books=Book::find($id);
        $books->delete();
        session()->flash('success','Book muvaffqatli ochirildi');
        return redirect(route('admin.book.index'));
    }
}
