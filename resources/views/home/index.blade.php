<x-home.master-home>
@section('page.title',$page_title)

@section('style')
  <link rel="stylesheet" href="{{asset('app/css/jquery.fancybox.min.css')}}" />
@endsection
@section('page.content')

    <section style="background: url({{ $HomePage->heading_background_image ?? 'img/hero.jpg'  }}); background-size: cover; background-position: center center" class="hero">
      <div class="container">
        <div class="row">
          <div class="col-lg-7">
            <h1>{{ $HomePage->heading ?? '' }}</h1>
            <a href="{{route('home.posts')}}" class="hero-link">Discover More</a>
          </div>
        </div><a href=".intro" class="continue link-scroll"><i class="fas fa-arrow-down"></i> Scroll Down</a>
      </div>
    </section>
    <!-- Intro Section-->
    <section class="intro">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <h2 class="h3"> {{ $HomePage->introduction_title ?? '' }} </h2>
            <p class="text-big">{{ $HomePage->introduction  ?? '' }}</p>
          </div>
        </div>
      </div>
    </section>
    <section class="featured-posts no-padding-top">
      <div class="container">

        
        @if(  $most_view_posts->count() >= 1 )
          @foreach ($most_view_posts as $key => $most_view_post )
          <?php 
          if ( $key & 1 ) {
            $image_hoder_left = "<div class='image col-lg-5'>
                            <img src='".$most_view_post->get_post_thumb_nail($most_view_post)."' alt='...'>
                          </div>";
            $image_hoder_right = '';             
          }else{
            $image_hoder_right = "<div class='image col-lg-5'>
                            <img src='".$most_view_post->get_post_thumb_nail($most_view_post)."' alt='...'>
                          </div>";
            $image_hoder_left = '';  
          }
          ?>
              <div class="row d-flex align-items-stretch">
                <?= $image_hoder_left ?>
                <div class="text col-lg-7">
                  <div class="text-inner d-flex align-items-center">
                    <div class="content">
                      <header class="post-header">
                        <div class="category">
                          <a href="#">{{$most_view_post->category->name}}</a>
                        </div>
                        <a href="{{route('home.post', $most_view_post->slug)}}">
                          <h2 class="h4 text-break">{{ $most_view_post->title }}</h2>
                        </a>
                      </header>
                      <p class="text-break">{{ $most_view_post->description }}</p>
                      <footer class="post-footer d-flex align-items-center">
                        <a href="{{route('home.user.post',$most_view_post->user)}}" class="author d-flex align-items-center flex-wrap">
                          <div class="avatar">
                            <img src="{{$most_view_post->user->get_user_avatar($most_view_post->user) }}" alt="..." class="img-fluid">
                          </div>
                          <div class="title"><span>{{$most_view_post->user->username}}</span></div>
                        </a>
                        <div class="date"><i class="fas fa-clock"></i> 
                          {{ $most_view_post->created_at->diffForHumans() }}
                        </div>
                        <div class="comments"><i class="fas fa-comments"></i>
                          {{ $most_view_post->get_post_active_comment_count($most_view_post) }}
                        </div>
                      </footer>
                    </div>
                  </div>
                </div>
                 <?= $image_hoder_right ?>
              </div>
          @endforeach
        @endif
      </div>
    </section>
   
    <!-- Divider Section-->
    <section style="background: url({{ $HomePage->about_background_image ?? 'img/divider-bg.jpg'  }}); background-size: cover; background-position: center bottom" class="divider">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h2>{{ $HomePage->about ?? '' }}</h2><a href="#" class="hero-link">View More</a>
          </div>
        </div>
      </div>
    </section>
    <!-- Latest Posts -->
    <section class="latest-posts"> 
      <div class="container">
        <header> 
          <h2>Latest from the blog</h2>
          <p class="text-big">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
        </header>
        <div class="row">
         @if(  $latest_posts->count() >= 1 )
              @foreach ($latest_posts as $latest_post)
                  <div class="post col-md-4">
                    <div class="post-thumbnail">
                      <a href="{{route('home.post', $latest_post->slug)}}">
                        <img src="{{$latest_post->get_post_thumb_nail($latest_post)}}" alt="..." class="img-fluid" />
                      </a>
                    </div>
                    <div class="post-details">
                      <div class="post-meta d-flex justify-content-between">
                        <div class="date">{{ $latest_post->created_at }} </div>
                        <div class="category">
                          <a href="{{route('home.category',$latest_post->category->name)}}">
                            {{ $latest_post->category->name }}
                          </a>
                        </div>
                      </div>
                      <a href="{{route('home.post', $latest_post->slug)}}">
                        <h3 class="h4 text-break">{{ $latest_post->title }} </h3>
                      </a>
                      <p class="text-muted text-break">{{ $latest_post->description }}</p>
                    </div>
                  </div>

              @endforeach
            @endif
        </div>
      </div>
    </section>

    <!-- Gallery Section-->
    <section class="gallery no-padding">    
      <div class="row">

        @if( $galleries->count() >= 1 )
          @foreach( $galleries as $gallery)
            <div class="mix col-lg-3 col-md-3 col-sm-6">
              <div class="item">
                <a href="{{ $gallery->image()->latest()->first()->name }}" 
                class="image" 
                data-caption="{{ $gallery->description }}"
                data-fancybox="gallery">
                  <img class="img-fluid" src="{{ $gallery->get_image($gallery) }}" alt="">
                  <div class="overlay d-flex align-items-center justify-content-center">
                    <i class="fas fa-search"></i>
                  </div>
                </a>

                </div>
            </div>

          @endforeach

        @else
<!--           <div class="mix col-lg-3 col-md-3 col-sm-6">
            <div class="item">
              <a href="img/gallery-1.jpg" data-fancybox="gallery" class="image">
                <img src="img/gallery-1.jpg" alt="..." class="img-fluid">
                <div class="overlay d-flex align-items-center justify-content-center">
                  <i class="fas fa-search"></i>
                </div>
              </a>
              </div>
          </div> -->
        @endif
      </div>
    </section>


@endsection

@section('script')
  <script src="{{asset('app/js/jquery.fancybox.min.js')}}"></script>
@endsection


</x-home.master-home>