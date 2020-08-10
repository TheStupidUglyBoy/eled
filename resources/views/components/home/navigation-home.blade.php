    <header class="header">
      <!-- Main Navbar-->
      <nav class="navbar navbar-expand-lg">
        <div class="container">
          <!-- Navbar Brand -->
          <div class="navbar-header d-flex align-items-center justify-content-between">

            <a class="navbar-brand" href="{{route('home')}}">
                <img src="{{asset('img/logo.png')}}" width="100"  class="d-inline-block align-top" alt="" loading="lazy">
            </a>
            <!-- Toggle Button-->
            <button type="button" data-toggle="collapse" data-target="#navbarcollapse" aria-controls="navbarcollapse" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler"><span></span><span></span><span></span></button>
          </div>
          <!-- Navbar Menu -->
          <div id="navbarcollapse" class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <a href="{{route('home')}}" class="nav-link {{ Request::is('/') ? 'active' : '' }} ">Home</a>
              </li>
              <li class="nav-item">
                <a href="{{route('home.posts')}}" class="nav-link {{ Request::is('posts') ? 'active' : '' }}">Post</a>
              </li>
              <li class="nav-item">
                <a href="{{route('home.news')}}" class="nav-link {{ Request::is('news') ? 'active' : '' }} ">News</a>
              </li>
              <li class="nav-item">
                <a href="{{route('home.tips')}}" class="nav-link {{ Request::is('tips') ? 'active' : '' }}">Tips & Tutorials</a>
              </li>
              <li class="nav-item">
                <a href="{{route('home.gallery')}}" class="nav-link {{ Request::is('gallery') ? 'active' : '' }}">Gallery</a>
              </li>

<!--               <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  EN
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="#">CN</a>
                  <a class="dropdown-item" href="#">JP</a>
                </div>
              </li> -->
              @if (  Auth::check() )
              <li class="nav-item">
                <a href="{{route('home.post.create')}}" class="nav-link }}">Create Post</a>
              </li>
              @if ( ! Auth::user()->IsBaseUser() )
              <li class="nav-item">
                <a href="{{route('admin_dashboard')}}" class="nav-link ">Admin</a>
              </li>
              @endif

              <li class="nav-item">
                <div class="navbar-text text-success">Welcome <strong>{{ Auth::user()->username}}</strong> </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">


                 <img class="img-profile rounded-circle" width='25' height="25" src="{{Auth::user()->get_user_avatar(Auth::user()) }}" alt="..." class="img-fluid">

                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{{route('user_profile')}}">
                    <i class="fas fa-user"></i> Profile
                  </a>
                  <a class="dropdown-item" href="{{route('user_profile', '#notification')}}">
                    <i class="fas fa-bell"></i> Notifications
                    @if(  $unread_notification_count  > 0)
                        <span class="badge badge-danger badge-counter">{{  $unread_notification_count  }}</span>
                    @endif
                  </a>
                  <a class="dropdown-item" href="{{route('home.post.all')}}">
                    <i class="fas fa-pen"></i> Post
                  </a>
                  <a class="dropdown-item" href="{{route('logout')}}">
                    <i class="fas fa-sign-out-alt"></i> Log Out
                  </a>
                </div>
              </li>
              
              @else
              <li class="nav-item"><a href="{{route('login')}}" class="nav-link {{ Request::is('user/login') ? 'active' : '' }}">Login</a>
              </li>
              @endif

            </ul>

            @if ( ! Auth::check() )
            <form class="form-inline my-2 my-lg-0">
              <a class="btn btn-success my-2 my-sm-0" href="{{route('create_register')}}">Sign Up Now</a>
            </form>
            @endif
          </div>
        </div>
      </nav>
    </header>