<div class="row">
  @foreach ($books as $book)
    <div class="col-md-4">
      <div class="single-book">
        <img src="{{ asset('assets/images/books/'.$book->image) }}" alt="">
        <div class="book-short-info">
          <h5>{{ $book->title }}</h5>
          <p>
            <a href="{{ route('users.profile', $book->user->username) }}" class=""><i class="fa fa-upload"></i> {{ $book->user->name }}</a>
          </p>

          

          @if (Route::is('users.dashboard.books'))
            <a href="{{ route('books.show', $book->slug) }}" class="btn btn-outline-primary"><i class="fa fa-eye"></i></a>
            
            <a href="{{ route('users.dashboard.books.edit', $book->slug) }}" class="btn btn-outline-success"><i class="fa fa-edit"></i></a>
            
            <a href="#deleteModal{{ $book->id }}" class="btn btn-outline-danger" data-toggle="modal"><i class="fa fa-trash"></i></a>

            <!-- Delete Modal -->
            <div class="modal fade" id="deleteModal{{ $book->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Are you sure to delete ?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    
                    <form action="{{ route('users.dashboard.books.delete', $book->id) }}" method="post">
                      @csrf

                      <div>
                        {{ $book->title }} o'chiriladi!!
                      </div>

                      <div class="mt-4">
                        <button type="submit" class="btn btn-primary">OK, tasdiqlang</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Bekor qilish</button>
                    </div>
                    </form>

                  </div>
                  
                </div>
              </div>
            </div>
            <!-- Delete Modal -->

          @else
            <a href="{{ route('books.show', $book->slug) }}" class="btn btn-outline-primary"><i class="fa fa-eye"></i> Ko'rinish</a>
            {{-- 
            <a href="" class="btn btn-outline-danger"><i class="fa fa-heart"></i> Wishlist</a> --}}
          @endif
          
        </div>
      </div>
    </div> <!-- Single Book Item -->
  @endforeach

</div>
