<div class="profile-sidebar border">
  <div class="widget">
    <h5 class="mb-2 border-bottom pb-3">
      <i class="fa fa-user default-user"></i>
    </h5>

    <div class="list-group mt-3">
      <a href="{{ route('users.profile', Auth::user()->username) }}" class="list-group-item list-group-item-action">
        Profil
      </a>
      <a href="{{ route('users.dashboard') }}" class="list-group-item list-group-item-action">
        Boshqaruv paneli
      </a>
      <a href="{{ route('users.dashboard.books') }}" class="list-group-item list-group-item-action">
        Mening yuklangan kitoblarim
      </a>

      <a href="{{ route('books.order.list') }}" class="list-group-item list-group-item-action">
        Mening buyurtma qilingan kitoblarim
      </a>
      <a href="{{ route('books.request.list') }}" class="list-group-item list-group-item-action">
        Mening so'rovlarim
      </a>
    </div>

  </div> <!-- Single Widget -->
</div>