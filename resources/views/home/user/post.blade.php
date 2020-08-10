<x-home.master-home>
@section('page.title',$page_title)


@section('page.content')

<div class="container">
      <div class="row">
        <!-- Latest Posts -->
        <main class="posts-listing col-lg-8"> 
          <div class="container">
            <div class="row">
              <div class="col-lg-6">
                <h1>{{$user->username}}</h1>
                <hr>
                <h3>Company</h3>
                @if (  !is_null($user->company)  )
                  <p>{{$user->username}} works for 
                    <a href="{{route('home.companies.show' , $user->company->id )}}"> <span class="text-success text-break">{{$user->company->name}}</span>  </a>
                  </p>
                  @if (  !is_null($user->company->website)  )
                    <p>visit <a target="_blank" class='text-success' href="{{$user->company->website}}">{{$user->company->name}}</a> Now</p>
                  @endif

                @else
                  <p>{{$user->username}} doesn't work at any company yet</p>
                @endif
                <hr>
                <h5>About Me</h5>
                <p>{{$user->bio}}</p>
                
              </div>
              <div class="col-lg-6 text-center">

                <img src="{{$user->get_user_avatar($user) }}" alt="..." class="img-fluid rounded-circle">

              </div>
              
            </div>
            <hr>
            <div class="row">
              @if (  $posts->isNotEmpty()   )
              @foreach ($posts as $post)
              <div class="post col-xl-6">
                <div class="post-thumbnail text-center">
                  <a href="{{route('home.post', $post->slug)}}">
                    <img src="{{$post->get_post_thumb_nail($post)}}" alt="..." class="img-fluid " 
                    style=""/>
                  </a>
                </div>
                <div class="post-details">
                  <div class="post-meta d-flex justify-content-between">
                    <div class="date meta-last">  {{ $post->created_at }}  </div>
                    <div class="category"><a href="{{route('home.category',$post->category->name)}}">{{ $post->category->name }}</a></div>
                  </div>

                  <a href="{{route('home.post', $post->slug)}}">
                    <h3 class="h4 text-break">{{ $post->title }}  </h3>
                  </a>

                  <p class="text-muted text-break">{{ $post->description }}</p>
                  <footer class="post-footer d-flex align-items-center">
                    <a href="{{route('home.user.post',$post->user )}}" class="author d-flex align-items-center flex-wrap">
                  <div class="avatar">
                    <img  src="{{$post->user->get_user_avatar($post->user) }}" alt="..." class="img-fluid">
                  </div>                      
                      <div class="title"><span>{{ $post->user->username }}</span></div>
                    </a>
                    <div class="date"><i class="fas fa-calendar"></i> {{ $post->created_at->diffForHumans()  }} </div>
                    <div class="comments meta-last"><i class="far fa-comment"></i> 12</div>
                  </footer>
                </div>
              </div>
              @endforeach
              @else
                  <h4 class='text-success'>No Data Available</h4>
              @endif
 
            </div>
            <!-- Pagination -->
            {{ $posts->links('home.pagination') }}

          </div>
        </main>
        

 <x-home.sidebar-home/>       
      </div>
    </div>



@endsection
</x-home.master-home>