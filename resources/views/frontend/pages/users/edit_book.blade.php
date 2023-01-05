@extends('frontend.layouts.app')

@section('styles')
  
  <!-- Select2 -->
  <link href="{{ asset('admin-asset/css/select2.min.css') }}" rel="stylesheet">


  <!-- Summer Note Text Editor -->
  <link href="{{ asset('admin-asset/css/summernote.css') }}" rel="stylesheet">

@endsection

@section('content')

<div class="main-content">

  <div class="book-show-area">
    <div class="container">
      <h3>
        Edit  Your Book
      </h3>
      <form action="{{ route('users.dashboard.books.update', $book->slug) }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="row">
          <div class="col-md-6">
            <label for="">Kitob nomi</label>
            <br>
            <input type="text" class="form-control" name="title" placeholder="Kitob nomi" value="{{ $book->title }}">
          </div>
          <div class="col-md-6">
            <label for="">Kitob URL matni</label>
            <br>
            <input type="text" class="form-control" name="slug" placeholder="Kitob URL matni"  value="{{ $book->slug }}">
          </div>
          
          <div class="col-md-6">
            <label for="">Kitob toifasi</label>
            <br>
             <select name="category_id" id="category_id" class="form-control">
              <option value="">Kategoriyani tanlang</option>
              @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ $book->category_id ==  $category->id ? 'selected' : ''}}>{{ $category->name }}</option>
              @endforeach
            </select>
          </div> 

          <div class="col-md-6">
            <label for="isbn">Kitob ISBN</label>
            <br>
             <input type="text" class="form-control" name="isbn" placeholder="Kitob ISBN" value="{{ $book->isbn }}">
          </div> 

          <div class="col-md-6">
            <label for="">Kitob muallifi</label>
            <br>
             <select name="author_ids[]" id="author_id" class="form-control select2" multiple>
              <option value="">Muallifni tanlang</option>
              @foreach ($authors as $author)
                <option value="{{ $author->id }}" {{ App\Book::isAuthorSelected($book->id, $author->id) ? 'selected' : '' }}>{{ $author->name }}</option>
              @endforeach
            </select>
          </div> 

          
          <div class="col-md-6">
            <label for="">Kitob nashriyoti</label>
            <br>
             <select name="publisher_id" id="publisher_id" class="form-control">
              <option value="">Kitob nashriyoti</option>
              @foreach ($publishers as $publisher)
                <option value="{{ $publisher->id }}"  {{ $book->publisher_id ==  $publisher->id ? 'selected' : ''}}>{{ $publisher->name }}</option>
              @endforeach
            </select>
          </div> 

          
          <div class="col-md-6">
            <label for="">Kitob nashr etilgan yili</label>
            <br>
             <select name="publish_year" id="publish_year" class="form-control">
              <option value="">Nashriyotchini tanlang</option>
              @for ($year = date('Y'); $year >= 1900 ; $year--)
                <option value="{{ $year }}"  {{ $book->publish_year ==   $year ? 'selected' : ''}}>{{ $year }}</option>
              @endfor
            </select>
          </div>

          <div class="col-md-6">
            <label for="image">Tavsiya etilgan kitob tasviri (ixtiyoriy) <a href="{{ asset('images/books/'.$book->image) }}" target="_blank">Old Image</a></label>
            <br>
            <input type="file" name="image" id="image" class="form-control">   
          </div>
          <div class="col-md-6">
            <label for="translator_id">Book Translator</label>
            <br>
             <select name="translator_id" id="translator_id" class="form-control select2">
              <option value="">Book Translator</option>
              @foreach ($books as $tb)
                <option value="{{ $tb->id }}" {{ $tb->id == $book->translator_id ? 'selected' : '' }}>{{ $tb->title }}</option>
              @endforeach
            </select>
          </div> 

          <div class="col-md-6">
            <label for="quantity">Kitob miqdori</label>
              <br>
              <input type="number" name="quantity" id="quantity" class="form-control" value="{{ $book->quantity }}" required min="1">   
          </div>


          
          
          <div class="col-12">
              <label for="summernote">Kitob tafsilotlari</label>
            <br>
            <textarea name="description" id="summernote" cols="30" rows="5" class="form-control" placeholder="Book Description"> {!! $book->description !!}</textarea>
          </div>
        </div>

        <div class="mt-4">
          <button type="submit" class="btn btn-primary">O'zgarishlarni saqlang</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Yopish</button>
      </div>
      </form>
    </div>
  </div>

</div>
@endsection

@section('scripts')

  <!-- Select2 JS -->
  <script src="{{ asset('admin-asset/js/select2.min.js') }}"></script>

  <!-- Summer Note JS -->
  <script src="{{ asset('admin-asset/js/summernote.js') }}"></script>


  <script>
      $(document).ready( function () {
          $('.select2').select2();
          $('#summernote').summernote();
      } );
    </script>
@endsection