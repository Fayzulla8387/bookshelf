@extends('frontend.layouts.app')

@section('content')

<div class="main-content">

  <div class="book-show-area">
    <div class="container">
      @include('frontend.layouts.partials.messages')
      <div class="row">

        <div class="col-md-3">
          
          <img src="{{ asset('assets/images/books/'.$book->image) }}" class="img img-fluid" />
        </div>
        <div class="col-md-9">
          <h3>{{ $book->title }}</h3>
          <p class="text-muted">Tomonidan yozilgan

            @foreach ($book->authors as $book_author)
              <span class="text-primary">{{ $book_author->author->name }}</span>
            @endforeach
             @<span class="text-info">{{ $book->category->name }}</span>
          </p>
          <hr>

          <p><strong>Yuklangan: </strong> {{ $book->user->name }}</p>
          <p><strong>Yuklangan: </strong> {{ $book->created_at->diffForHumans() }}</p>
          <p>
            <strong>Nashr qilingan: </strong> {{ $book->publish_year }},
            <strong>Nashriyot: </strong> {{ $book->publisher->name }},
            <strong>ISBN: </strong> {{ $book->isbn }}
          </p>
          
          <div class="book-description">
            {!! $book->description !!}
          </div>

          <div class="book-buttons mt-4">
              {{-- <a href="" class="btn btn-outline-success"><i class="fa fa-check"></i> Already Read</a>
              <a href="book-view.html" class="btn btn-outline-warning"><i class="fa fa-cart-plus"></i> Add to Cart</a>
              <a href="" class="btn btn-outline-danger"><i class="fa fa-heart"></i> Add to Wishlist</a> --}}
              
              @auth

              @if ($book->quantity > 0)
                @if (!is_null(App\User::bookRequest($book->id)))
                  
                  @if (App\User::bookRequest($book->id)->status == 1)
                  <span class="badge badge-success" style="padding: 12px;border-radius: 0px;font-size: 14px;">
                    <i class="fa fa-check"></i> Allaqachon so'ralgan
                  </span>
                  @endif

                  @if (App\User::bookRequest($book->id)->status == 2)
                  <span class="badge badge-success" style="padding: 12px;border-radius: 0px;font-size: 14px;">
                    <i class="fa fa-check"></i>Egasi tasdiqlandi
                  </span>
                  @endif

                  @if (App\User::bookRequest($book->id)->status == 3)
                  <span class="badge badge-danger" style="padding: 12px;border-radius: 0px;font-size: 14px;">
                    <i class="fa fa-times"></i>Egasi rad etildi
                  </span>
                  @endif


                  @if (App\User::bookRequest($book->id)->status == 4)
                  <span class="badge badge-success" style="padding: 12px;border-radius: 0px;font-size: 14px;">
                    <i class="fa fa-check"></i> O'qish...
                  </span>
                  @endif

                 @if (App\User::bookRequest($book->id)->status == 4)
                  <a href="#returnBookModal{{ $book->id }}" class="btn btn-outline-warning" data-toggle="modal"><i class="fa fa-arrow-right"></i>Qaytish kitobi</a>

                  <div class="modal fade" id="returnBookModal{{ $book->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                      <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">
                              Qaytish<mark>{{ $book->title }}</mark>
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form action="{{ route('books.return.store', App\User::bookRequest($book->id)->id) }}" method="post">
                              @csrf
                              
                              <p>
                                Kitobni qaytarib berishga ishonchingiz komilmi?
                              </p>
                              
                              <button type="submit" class="btn btn-success mt-4">
                                <i class="fa fa-send"></i> Qaytish so'rovini yuborish
                              </button>

                              <button type="button" class="btn btn-secondary mt-4" data-dismiss="modal">Bekor qilish</button>

                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                 @endif

                  @if (App\User::bookRequest($book->id)->status == 1)

                    <a href="#requestUpdateModal{{ $book->id }}" class="btn btn-outline-success" data-toggle="modal"><i class="fa fa-check"></i> Update Request</a>

                    <form action="{{ route('books.request.delete', App\User::bookRequest($book->id)->id) }}" method="post" style="display: inline-block;">
                      @csrf 
                      <button type="submit" class="btn btn-danger"><i class="fa fa-times"></i>So'rovni bekor qilish</button>
                    </form>


                    <div class="modal fade" id="requestUpdateModal{{ $book->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                      <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">
                              Yangilash uchun so'rov <mark>{{ $book->title }}</mark>
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form action="{{ route('books.request.update', App\User::bookRequest($book->id)->id) }}" method="post">
                              @csrf
                              
                              <p>
                                Ushbu kitob egasiga so'rovingizni yangilaysizmi?
                              </p>
                                <textarea name="user_message" id="user_message" class="form-control" rows="5" placeholder="Xatingizni egasiga kiriting (xabar bo'lmasa, bo'sh qoldiring)" >{{  App\User::bookRequest($book->id)->user_message }}</textarea>

                              <button type="submit" class="btn btn-success mt-4">
                                <i class="fa fa-send"></i> Hoziroq so'rov yuboring
                              </button>
                              <button type="button" class="btn btn-secondary mt-4" data-dismiss="modal">Bekor qilish</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  @endif
                @else
                   <a href="#requestModal{{ $book->id }}" class="btn btn-outline-success" data-toggle="modal"><i class="fa fa-check"></i> Send Request</a>
                
                @endif
                @else
                <span class="badge badge-success" style="padding: 12px;border-radius: 0px;font-size: 14px;">
                 Kimdir bu kitobni o'qiyapti...
                </span>
              @endif

                
              @endauth

             

             

              <div class="modal fade" id="requestModal{{ $book->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">
                        Request for <mark>{{ $book->title }}</mark>
                      </h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form action="{{ route('books.request', $book->slug) }}" method="post">
                        @csrf
                        
                        <p>
                          Send a request to the owner of this book ?
                        </p>
                        <textarea name="user_message" id="user_message" class="form-control" rows="5" placeholder="Enter your message to the owner (Keep empty if there is no message)" ></textarea>

                        <button type="submit" class="btn btn-success mt-4">
                          <i class="fa fa-send"></i> Send Request Now
                        </button>
                        <button type="button" class="btn btn-secondary mt-4" data-dismiss="modal">Cancel</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>


          </div>
        </div>

      </div>
    </div>
  </div>

</div>
@endsection