@extends('frontend.layouts.app')

@section('content')

<div class="main-content">

  <div class="login-area page-area">
    <div class="container">
      <div class="row">
          <div class="col-md-8 p-1">
            <div class="profile-tab border p-2">
              <h3 class="">
                  Mening buyurtma qilingan kitoblarim
              </h3>
              <hr>

              <div class="table-responsive">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Sl</th>
                        <th>Kitob</th>
                        <th>Egasi</th>
                        <th>Xabar</th>
                        <th>Harakat</th>
                      </tr>
                      @foreach ($book_orders as $br)
                        <tr>
                          <td>{{ $loop->index+1 }}</td>
                          <td>
                            <a href="{{ route('books.show', $br->book->slug) }}">{{ $br->book->title }}</a>
                          </td>
                          <td>
                            {{ $br->owner->name }}
                            <br>
                            <a href="tel:{{ $br->owner->phone_no }}" class="btn btn-info"><i class="fa fa-phone" title="Call to the User"></i></a>
                          </td>
                          <td>
                            {{ $br->owner_message }}
                          </td>

                          <td>
                            @if ($br->status == 1)
                                  So'rov yuborildi
                            @elseif($br->status == 2)
                                  Egasi ma'qullangan
                            @elseif($br->status == 3)
                                  Egasi rad etildi
                            @elseif($br->status == 4)
                                  Tasdiqlangan
                            @elseif($br->status == 5)
                                  Rad etilgan
                            @endif

                            @if ($br->status == 2)
                              <form action="{{ route('books.order.approve', $br->id) }}" method="post">
                              @csrf
                                <button type="submit" class="btn btn-success">Tasdiqlash</button>
                              </form>

                              <form action="{{ route('books.order.reject', $br->id) }}" method="post" class="mt-1">
                                @csrf
                                <button type="submit" class="btn btn-danger">Rad etish</button>
                              </form>

                            @endif

                            

                          </td>
                        </tr>
                      @endforeach
                    </thead>
                  </table>
                  {{ $book_orders->links() }}
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