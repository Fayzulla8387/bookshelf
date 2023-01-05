    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.index')}}">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-file"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin Panel</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin.index')}}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Boshqaruv paneli</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Interfeys
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-file"></i>
          <span>Kitoblar</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Kitoblar va barchasini boshqarish</h6>
            <a class="collapse-item" href="{{ route('admin.books.index') }}">Barcha kitoblar</a>
            <a class="collapse-item" href="{{ route('admin.books.unapproved') }}">
              Tasdiqlanmagan kitoblar
              <span class="badge badge-warning">
                {{ count(App\Book::where('is_approved', 0)->get()) }}
              </span>
            </a> 
            <a class="collapse-item" href="{{ route('admin.books.approved') }}">
              Approved Books 
              <span class="badge badge-success">
                {{ count(App\Book::where('is_approved', 1)->get()) }}
              </span>
            </a>
            <a class="collapse-item" href="{{ route('admin.books.create') }}">Kitob yaratish</a>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.categories.index') }}">
          <i class="fas fa-fw fa-th"></i>
          <span>Kategoriyalar</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.authors.index') }}">
          <i class="fas fa-fw fa-user"></i>
          <span>Mualliflar</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.publishers.index') }}">
          <i class="fas fa-fw fa-bell"></i>
          <span>Nashriyotchilar</span></a>
      </li>


      <!-- Nav Item - Utilities Collapse Menu -->
      {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Utilities</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Utilities:</h6>
            <a class="collapse-item" href="utilities-color.html">Colors</a>
            <a class="collapse-item" href="utilities-border.html">Borders</a>
            <a class="collapse-item" href="utilities-animation.html">Animations</a>
            <a class="collapse-item" href="utilities-other.html">Other</a>
          </div>
        </div>
      </li> --}}

      <!-- Divider -->
      {{-- <hr class="sidebar-divider"> --}}

      <!-- Heading -->
      {{-- <div class="sidebar-heading">
        Addons
      </div> --}}

      <!-- Nav Item - Pages Collapse Menu -->
      {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-folder"></i>
          <span>Pages</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Login Screens:</h6>
            <a class="collapse-item" href="login.html">Login</a>
            <a class="collapse-item" href="register.html">Register</a>
            <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
            <div class="collapse-divider"></div>
            <h6 class="collapse-header">Other Pages:</h6>
            <a class="collapse-item" href="404.html">404 Page</a>
            <a class="collapse-item" href="blank.html">Blank Page</a>
          </div>
        </div>
      </li> --}}

      <!-- Nav Item - Charts -->
      
      <!-- Nav Item - Tables -->
      {{-- <li class="nav-item">
        <a class="nav-link" href="tables.html">
          <i class="fas fa-fw fa-table"></i>
          <span>Tables</span></a>
      </li> --}}

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->