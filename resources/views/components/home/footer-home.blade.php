<!-- Page Footer-->
    <footer class="main-footer">
      <div class="container">
        <div class="row">
          <div class="col-md-4 ">
            <div class="logo">
              <h6 class="text-white">ELED Community</h6>
            </div>
            <div class="contact-details">
              <address>
                  baoan district, Shen zhen , China<br>
            Phone: (020) 123 456 789

              </address>
              <p>Email: <a href="mailto:info@company.com">support@eled.net</a></p>
              <ul class="social-menu">
                <li class="list-inline-item"><a href="https://facebook.com"><i class="fab fa-facebook"></i></a></li>
                <li class="list-inline-item"><a href="https://youtube.com"><i class="fab fa-youtube"></i></i></a></li>
                <li class="list-inline-item"><a href="https://instagram.com"><i class="fab fa-instagram"></i></a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-4 ">
            <div class="menus d-flex">
              <ul class="list-unstyled">
                <li> <a href="{{route('user_profile')}}">My Account</a></li>
                <li> <a href="{{route('create_register')}}">Sign Up</a></li>
                <li> <a href="{{route('login')}}">Log In</a></li>
                <li> <a href="{{route('home.companies')}}">Companies</a></li>
              </ul>
              <ul class="list-unstyled">
                <li> <a href="{{route('home.gallery')}}">Gallery</a></li>
                <li> <a href="{{route('home.video')}}">Videos</a></li>
                <li> <a href="{{route('home.news')}}">News</a></li>
                <li> <a href="{{route('home.tips')}}">Tips</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-4 ">
            <div class="latest-posts">
              @if(  $latest_posts->count() >= 1 )
                @foreach ($latest_posts as $latest_post)
                    <a href="{{route('home.post', $latest_post->slug)}}">
                      <div class="post d-flex align-items-center">
                        <div class="image">
                          <img src="{{$latest_post->get_post_thumb_nail($latest_post)}}" alt="..." class="img-fluid" />
                        </div>
                        <div class="title">
                          <strong class="text-break">{{ $latest_post->title }}</strong>
                          <span class="date last-meta">{{ $latest_post->created_at }}</span>
                        </div>
                      </div>
                    </a>
                @endforeach
              @endif
            </div>
          </div>
        </div>  
      </div>
      <div class="copyrights">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <p>&copy; 2020 - {{date('Y')}}. ELED Community All rights reserved.</p>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <!-- JavaScript files-->


   