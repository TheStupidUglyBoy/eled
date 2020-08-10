<x-home.master-home>
@section('page.title',$page_title)


@section('page.content')

<div class="container">
      <div class="row">
        <!-- Latest Posts -->
        <main class="posts-listing col-lg-8"> 
          <div class="container">
            <div class="row">
              <div class="col-lg-12">
              
              <ul class="list-group list-group-flush">



                @if (  $news->count() >= 0    )
                  @foreach ($news as $new)
                     <li class="list-group-item d-flex justify-content-between align-items-center">
                        <a href="{{route('home.news.show',$new->slug)}}">{{ $new->title }}</a>
                        <span class="badge badge-success badge-pill">{{ $new->created_at->diffForHumans() }}</span>
                      </li>

                  @endforeach
                @else
                    <h4 class='text-success'>No News Available</h4>
                @endif
              </ul>
              </div>
            </div>
            <!-- Pagination -->
            {{ $news->links('home.pagination') }}

          </div>
        </main>
        

 <x-home.sidebar-home/>       
      </div>
    </div>



@endsection
</x-home.master-home>