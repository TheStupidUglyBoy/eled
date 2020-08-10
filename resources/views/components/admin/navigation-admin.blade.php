<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('admin_dashboard')}}">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-lightbulb"></i>
        </div>
        <div class="sidebar-brand-text mx-3">ELED Admin <sup>2</sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item {{ Request::is('superadmin/dashboard') ? 'active' : '' }} ">
        <a class="nav-link" href="{{route('admin_dashboard')}}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('home')}}" target="_blank">
          <i class="fas fa-home"></i>
          <span>Home</span></a>
      </li>


      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Interface
      </div>

      @if (  Auth::user()->IsAdmin()  )
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item {{ Request::is('superadmin/admin_user') ? 'active' : '' }}  ">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#users" aria-expanded="true" aria-controls="users">
          <i class="fas fa-user"></i>
          <span>Users Section</span>
        </a>
        <div id="users" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{route('admin_user.index')}}">Users</a>
            <a class="collapse-item" href="{{route('admin_user.create')}}">Create</a>
            

          </div>
        </div>
      </li>
      @endif

      <li class="nav-item {{ Request::is('superadmin/post') ? 'active' : '' }} ">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#posts" aria-expanded="true" aria-controls="posts">
          <i class="fas fa-blog"></i>
          <span>Posts Section</span>
        </a>
        <div id="posts" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{route('post.index')}}">Posts</a>
            <a class="collapse-item" href="{{route('admin_trash_post')}}">Trash Posts</a>
            <a class="collapse-item" href="{{route('post.create')}}">Create</a>
            

          </div>
        </div>
      </li>

      @if (  Auth::user()->IsAdmin()  )
      <li class="nav-item {{ Request::is('superadmin/category') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#category" aria-expanded="true" aria-controls="category">
          <i class="fas fa-tv"></i>
          <span>Category Section</span>
        </a>
        <div id="category" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{route('category.index')}}">Category</a>
            <a class="collapse-item" href="{{route('category.create')}}">Create</a>
            

          </div>
        </div>
      </li>
      @endif

      <li class="nav-item {{ Request::is('superadmin/news') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#news" aria-expanded="true" aria-controls="news">
          <i class="fas fa-newspaper"></i>
          <span>News Section</span>
        </a>
        <div id="news" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{route('news.index')}}">News</a>
            <a class="collapse-item" href="{{route('news.create')}}">Create</a>
          </div>
        </div>
      </li>

      <li class="nav-item {{ Request::is('superadmin/tip') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#tips" aria-expanded="true" aria-controls="news">
          <i class="fas fa-school"></i>
          <span>Tips Section</span>
        </a>
        <div id="tips" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{route('tip.index')}}">Tips</a>
            <a class="collapse-item" href="{{route('tip.create')}}">Create</a>
          </div>
        </div>
      </li>

      @if (  Auth::user()->IsAdmin()  )
      <li class="nav-item {{ Request::is('superadmin/gallery') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#gallery" aria-expanded="true" aria-controls="gallery">
          <i class="fas fa-images"></i>
          <span>Gallery Section</span>
        </a>
        <div id="gallery" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{route('gallery.index')}}">Gallery</a>
            <a class="collapse-item" href="{{route('gallery.create')}}">Create</a>
          </div>
        </div>
      </li>

      <li class="nav-item {{ Request::is('superadmin/video') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#video" aria-expanded="true" aria-controls="video">
          <i class="fas fa-video"></i>
          <span>Video Section</span>
        </a>
        <div id="video" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{route('video.index')}}">Video</a>
            <a class="collapse-item" href="{{route('video.create')}}">Upload</a>
          </div>
        </div>
      </li>

      <li class="nav-item {{ Request::is('superadmin/page/home') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#page" aria-expanded="true" aria-controls="page">
          <i class="fas fa-book"></i>
          <span>Page</span>
        </a>
        <div id="page" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{route('page.home.edit')}}">Home</a>
          </div>
        </div>
      </li>

      @endif
      
      <li class="nav-item {{ Request::is('superadmin/comment') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#comment" aria-expanded="true" aria-controls="news">
          <i class="fas fa-comment"></i>
          <span>Comment Section</span>
        </a>
        <div id="comment" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{route('admin_comment')}}">Comment</a>
          </div>
        </div>
      </li>

      @if (  Auth::user()->IsAdmin()  )
      <li class="nav-item {{ Request::is('superadmin/company') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#company" aria-expanded="true" aria-controls="company">
          <i class="fas fa-tv"></i>
          <span>Company Section</span>
        </a>
        <div id="company" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{route('admin.company.all_company')}}">Company</a>
            <a class="collapse-item" href="{{route('admin.company.create')}}">Create</a>
          </div>
        </div>
      </li>
      @endif

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>