<x-home.master-home>
@section('page.title',$page_title)


@section('page.content')

<div class="container">
      <div class="row">

        <main class="post blog-post col-lg-8"> 
          <div class="container">
            <div class="post-single">
              <div class="post-details">
                <h1>{{ $news->getAttributes()['title'] }}</h1>
                <div class="post-footer d-flex align-items-center flex-column flex-sm-row">
                <a href="{{route('home.user.post',$news->user)}}" class="author d-flex align-items-center flex-wrap">
                  <div class="avatar">
                    <img  src="{{$news->user->get_user_avatar($news->user) }}" alt="..." class="img-fluid">
                  </div>
                  <div class="title"><span>{{ $news->user->username }}</span></div>
                </a>
                  <div class="d-flex align-items-center flex-wrap">       
                    <div class="date"><i class="fas fa-clock"></i>{{ $news->created_at }} </div>
                    <div class="date"><i class="fas fa-calendar"></i>{{ $news->created_at->diffForHumans() }} </div>
                    

                  </div>
                </div>
                <div class="post-body">

                
                  
                  {!! $news->get_news_image($news) !!}


                  {!!    clean($news->getAttributes()['body'])   !!}
                </div>
              
              </div>
            </div>
          </div>
        </main>
 <x-home.sidebar-home/>       
      </div>
    </div>



@endsection



</x-home.master-home>