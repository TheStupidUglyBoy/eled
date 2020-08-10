<x-home.master-home>
@section('page.title',$page_title)


@section('page.content')

<div class="container">
      <div class="row">

        <main class="post blog-post col-lg-8"> 
          <div class="container">
            <div class="post-single">
              <div class="post-details">
                <div class="post-meta d-flex justify-content-between">
                  <div class="category"><a href="{{route('home.category',$post->category->name)}}"> {{ $post->category->name }} </a></div>
                </div>
                <h1>{{ $post->getAttributes()['title'] }}</h1>
                <div class="post-footer d-flex align-items-center flex-column flex-sm-row">
                <a href="{{route('home.user.post',$post->user)}}" class="author d-flex align-items-center flex-wrap">
                  <div class="avatar">
                    <img  src="{{$post->user->get_user_avatar($post->user) }}" alt="..." class="img-fluid">
                  </div>
                  <div class="title"><span>{{ $post->user->username }}</span></div>
                </a>
                  <div class="d-flex align-items-center flex-wrap">       
                    <div class="date"><i class="fas fa-calendar"></i>{{ $post->created_at->diffForHumans() }} </div>
                    <div class="views"><i class="fas fa-eye"></i>  {{  views($post)->unique()->count() }}    </div>
                    <div class="comments meta-last"><i class="fas fa-comments"></i>
                      {{ $post->get_post_active_comment_count($post) }}
                    </div>
                  </div>
                </div>

                <div class="post-body">
                  {!!    clean($post->getAttributes()['description'])   !!}
                </div>
                

              
              </div>
            </div>
          </div>
        </main>
 <x-home.sidebar-home/>       
      </div>
    </div>



@endsection


@section('script')
<script type="text/javascript">
  
  //var post_title = 
  alert("You are Previewing post with POST TITLE " + "{{$post->title}}" + "If you like how the post look go ahead publish it.");
</script>
@endsection
</x-home.master-home>