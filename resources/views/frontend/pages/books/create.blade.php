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
        Kitobingizni yuklang
      </h3>
      @if (Auth::check())
        <form action="{{ route('books.store') }}" method="post" enctype="multipart/form-data">
              @csrf

              <div class="row">
                <div class="col-md-6">
                  <label for="">Kitob nomi</label>
                  <br>
                  <input type="text" class="form-control" name="title" placeholder="Kitob nomi">
                </div>
                <div class="col-md-6">
                  <label for="">Kitob URL matni</label>
                  <br>
                  <input type="text" class="form-control" name="slug" placeholder="Kitob URL matni">
                </div>
                
                <div class="col-md-6">
                  <label for="">Kitob toifasi</label>
                  <br>
                   <select name="category_id" id="category_id" class="form-control">
                    <option value="">Kategoriyani tanlang</option>
                    @foreach ($categories as $category)
                      <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                  </select>
                </div> 

                <div class="col-md-6">
                  <label for="isbn">Kitob ISBN</label>
                  <br>
                   <input type="text" class="form-control" name="isbn" placeholder="Kitob ISBN">
                </div> 

                <div class="col-md-6">
                  <label for="">Kitob muallifi</label>
                  <br>
                   <select name="author_ids[]" id="author_id" class="form-control select2" multiple>
                    <option value="">Muallifni tanlang</option>
                    @foreach ($authors as $author)
                      <option value="{{ $author->id }}">{{ $author->name }}</option>
                    @endforeach
                  </select>
                </div> 

                
                <div class="col-md-6">
                  <label for="">Kitob nashriyoti</label>
                  <br>
                   <select name="publisher_id" id="publisher_id" class="form-control">
                    <option value="">Nashriyotchini tanlang</option>
                    @foreach ($publishers as $publisher)
                      <option value="{{ $publisher->id }}">{{ $publisher->name }}</option>
                    @endforeach
                  </select>
                </div> 

                
                <div class="col-md-6">
                  <label for="">Kitob nashr etilgan yili</label>
                  <br>
                   <select name="publish_year" id="publish_year" class="form-control">
                    <option value="">Nashriyotchini tanlang</option>
                    @for ($year = date('Y'); $year >= 1900 ; $year--)
                      <option value="{{ $year }}">{{ $year }}</option>
                    @endfor
                  </select>
                </div>

                <div class="col-md-6">
                  <label for="image">Kitob tavsiya etilgan rasm</label>
                    <br>
                    <input type="file" name="image" id="image" class="form-control" required>   
                </div>
                <div class="col-md-6">
                  <label for="translator_id">Kitob tarjimon</label>
                  <br>
                   <select name="translator_id" id="translator_id" class="form-control select2">
                    <option value="">Tarjimon kitobini tanlang</option>
                    @foreach ($books as $book)
                      <option value="{{ $book->id }}">{{ $book->title }}</option>
                    @endforeach
                  </select>
                </div> 
                
                <div class="col-md-6">
                  <label for="quantity">Kitob miqdori</label>
                    <br>
                    <input type="number" name="quantity" id="quantity" class="form-control" value="1" required min="1">   
                </div>

                
                
                <div class="col-12">
                  <label for="summernote">Kitob tafsilotlari</label>
                  <br>
                  <textarea name="description" id="summernote" cols="30" rows="5" class="form-control" placeholder="Kitob tafsilotlari"></textarea>
                </div>
              </div>

              <div class="mt-4">
                <button type="submit" class="btn btn-primary">O'zgarishlarni saqlang</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Bekor qilish</button>
            </div>
        </form>
      @else
      <div class="card card-body">
        <p>
          <a href="{{ route('login') }}" class="btn btn-primary">
            Iltimos, kitobingizni yuklash uchun tizimga kiring
        </a>
        </p>
      </div>

      @endif
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