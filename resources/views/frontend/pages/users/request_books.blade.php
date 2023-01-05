@extends('frontend.layouts.app')

@section('content')

<div class="main-content">

  <div class="login-area page-area">
    <div class="container">
      <div class="row">
          <div class="col-md-8 p-1">
            <div class="profile-tab border p-2">
              <h3 class="">
                  Mening so'ragan kitoblarim
              </h3>
              <hr>

              <div class="table-responsive">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Sl</th>
                        <th>Kitob</th>
                        <th>So'rovchi</th>
                        <th>Xabar</th>
                        <th>Harakat</th>
                      </tr>
                      @foreach ($book_requests as $br)
                        <tr>
                          <td>{{ $loop->index+1 }}</td>
                          <td>
                            <a href="{{ route('books.show', $br->book->slug) }}">{{ $br->book->title }}</a>
                          </td>
                          <td>
                            {{ $br->user->name }}
                            <br>
                            <a href="tel:{{ $br->user->phone_no }}" class="btn btn-info"><i class="fa fa-phone" title="Call to the User"></i></a>
                          </td>
                          <td>
                            {{ $br->user_message }}
                          </td>
                          <td>
                            @if ($br->status == 1)
                                  So'rov yuborildi
                            @elseif($br->status == 2)
                                  So'rov tasdiqlandi
                            @elseif($br->status == 3)
                                  So'rov rad etildi
                            @elseif($br->status == 4)
                                  Foydalanuvchini tasdiqlash
                            @elseif($br->status == 5)
                                  Foydalanuvchi rad etildi
                            @elseif($br->status == 6)
                                  Qaytish so'rovi
                            @elseif($br->status == 7)
                                  Qaytish tasdiqlangan
                            @endif

                            @if ($br->status == 1)
                              <form action="{{ route('books.request.approve', $br->id) }}" method="post">
                              @csrf
                                <button type="submit" class="btn btn-success">Tasdiqlash</button>
                              </form>

                              <form action="{{ route('books.request.reject', $br->id) }}" method="post" class="mt-1">
                                @csrf
                                <button type="submit" class="btn btn-danger">Rad etish</button>
                              </form>

                              @elseif($br->status == 2)
                               <form action="{{ route('books.request.reject', $br->id) }}" method="post" class="mt-1">
                                @csrf
                                <button type="submit" class="btn btn-danger">Rad etish</button>
                              </form>

                              @elseif($br->status == 3)
                              <form action="{{ route('books.request.approve', $br->id) }}" method="post">
                              @csrf
                                <button type="submit" class="btn btn-success">Approve</button>
                              </form>

                              @elseif($br->status == 6)

                              <form action="{{ route('books.return.confirm', $br->id) }}" method="post">
                              @csrf
                                <button type="submit" class="btn btn-success">Qaytishni tasdiqlang</button>
                              </form>
                            @endif

                            

                          </td>
                        </tr>
                      @endforeach
                    </thead>
                  </table>
                  {{ $book_requests->links() }}
              </div>

            </div>
          </div>

          <div class="col-md-4 p-1">
            @include('frontend.pages.users.partials.sidebar')
          </div>

      </div>
    </div>
  </div>

</div>
@endsection