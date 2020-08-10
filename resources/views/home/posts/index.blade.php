<x-home.master-home>
@section('page.title',$page_title)


@section('page.content')

<div class="container">
      <div class="row">
        <!-- Latest Posts -->
        <main class="posts-listing col-lg-8"> 
          <div class="container">
            <div class="row">
              
              @if (  $posts->isNotEmpty()   )
              @foreach ($posts as $post)
              <div class="post col-xl-6" >
                <div class="post-thumbnail text-center">
                  <a href="{{route('home.post', $post->slug)}}">
                    <img src="{{$post->get_post_thumb_nail($post)}}" alt="..." class="img-fluid " 
                    style=""/>
                  </a>
                </div>
                <div class="post-details">
                  <div class="post-meta d-flex justify-content-between">
                    <div class="date meta-last">  {{ $post->created_at }}  </div>
                    <div class="category">
                      <a href="{{route('home.category',$post->category->name ?? 'no category' )}}">
                        {{ $post->category->name ?? 'No caterogry'}}
                      </a>
                    </div>
                  </div>

                  <a href="{{route('home.post', $post->slug)}}">
                    <h3 class="h4 text-break">{{   $post->title }}</h3>
                  </a>

                  <p class="text-muted text-break">{{ $post->description }}</p>
                  <footer class="post-footer d-flex align-items-center">
                    <a href="{{route('home.user.post',$post->user )}}" class="author d-flex align-items-center flex-wrap">
                  <div class="avatar">
                     <img  src="{{$post->user->get_user_avatar($post->user) }}" alt="..." class="img-fluid">
                  </div>                      
                      <div class="title"><span>{{ $post->user->username ?? 'No Author'}}</span></div>
                    </a>
                    <div class="date">
                        <i class="fas fa-calendar"></i>
                        {{ $post->created_at->diffForHumans()  }} 
                    </div>
                    <div class="comments meta-last"><i class="fas fa-comments"></i>
                      {{ $post->get_post_active_comment_count($post) }}
                    </div>
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