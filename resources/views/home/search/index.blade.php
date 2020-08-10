<x-home.master-home>
@section('page.title',$page_title)


@section('page.content')

<div class="container">
      <div class="row">
        <main class="posts-listing col-lg-12"> 

              <h2>Search</h2>
              <br>
              <p> There are <span class="text-success">{{ $searchResults->count() }}</span> results. </p>

              @foreach($searchResults->groupByType() as $type => $modelSearchResults)
                 <h4>{{ $type }} that contains <span class="text-warning">{{ $keyword}}</span> </h4>
                 <ul class="list-group">
                 @foreach($modelSearchResults as $searchResult)
                          <li class="list-group-item justify-content-between align-items-center">
                            <a href="{{ $searchResult->url }}">{{ $searchResult->title }}</a>

                            

                            @foreach( $searchResult->searchable->tagArray as $post_tag)
                                <span class="badge badge-success badge-pill">#{{  $post_tag }}</span>
                            @endforeach
                          </li>
                 @endforeach
                 </ul>
              @endforeach
        </main>
      </div>
    </div>



@endsection
</x-home.master-home>