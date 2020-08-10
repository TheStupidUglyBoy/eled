<aside class="col-lg-4">
          <!-- Widget [Search Bar Widget]-->
          <div class="widget search">
            <header>
              <h3 class="h6">Search the blog</h3>
            </header>
            <form method="GET" action="{{route('home.search')}}" class="search-form" id="search-form" >
              <div class="form-group">

                <input type="text" name="keyword" id="search-input" placeholder="What are you looking for?" autocomplete="off">

                <button type="submit" class="submit"><i class="fas fa-search"></i></button>
              </div>


              <ul id="searchResults" style="display: none;list-style-type: none; "></ul>
            </form>
          </div>

          <!-- Widget [Most View Posts Widget]        -->
          <div class="widget latest-posts">
            <header>
              <h3 class="h6">Most View Posts</h3>
            </header>
            <div class="blog-posts">
              @if(  $most_view_posts->count() >= 1 )
                @foreach ($most_view_posts as $most_view_post )
                    <a href="{{route('home.post', $most_view_post->slug)}}">
                      <div class="item d-flex align-items-center">
                        <div class="image">
                          <img src="{{$most_view_post->get_post_thumb_nail($most_view_post)}}" alt="..." class="img-fluid" />
                          
                        </div>
                        <div class="title ">
                          <strong class="text-break">  {{ $most_view_post->title }}  </strong>

                          <div class="d-flex align-items-center">
                            <div class="views"><i class="fas fa-eye"></i>
                              {{  views($most_view_post)->unique()->count() }}  
                            </div>
                            <div class="comments"><i class="fas fa-comments"></i>
                              {{ $most_view_post->get_post_active_comment_count($most_view_post) }}
                            </div>
                          </div>
                        </div>
                      </div>
                    </a>
                @endforeach
              @else
                  <div>No Post</div>
              @endif
            </div>
          </div>

          <!-- Widget [Latest Posts Widget]        -->
          <div class="widget latest-posts">
            <header>
              <h3 class="h6">Latest Posts</h3>
            </header>
            <div class="blog-posts">
            @if(  $latest_posts->count() >= 1 )
                @foreach ($latest_posts as $latest_post)
                    <a href="{{route('home.post', $latest_post->slug)}}">
                      <div class="item d-flex align-items-center">
                        <div class="image">
                          <img src="{{$latest_post->get_post_thumb_nail($latest_post)}}" alt="..." class="img-fluid" />
                          
                        </div>
                        <div class="title text-break"><strong>  {{ $latest_post->title }}  </strong>
                          <div class="d-flex align-items-center">
                            <div class="views"><i class="fas fa-eye"></i>
                              {{  views($latest_post)->unique()->count() }}  
                            </div>
                            <div class="comments"><i class="fas fa-comments"></i>
                              {{ $latest_post->get_post_active_comment_count($latest_post) }}
                            </div>
                          </div>
                        </div>
                      </div>
                    </a>
                @endforeach
              @else
                  <div>No Post</div>
              @endif
            </div>
          </div>
          <!-- Widget [Categories Widget]-->
          <div class="widget categories">
            <header>
              <h3 class="h6">Categories</h3>
            </header>

            @if(  $all_categories->count() >= 1 )
              @foreach ($all_categories as $category)
                <div class="item d-flex justify-content-between"><a href="{{route('home.category',$category->name)}}">{{$category->name}}</a>
                  <span>{{ $category->post()->where(['is_active' => 1 ])->count() }}</span>
                </div>
              @endforeach
            @else
                <div>No CATEGORIES</div>
            @endif
          </div>
          <!-- Widget [Tags Cloud Widget]-->
          <div class="widget tags">       
            <header>
              <h3 class="h6">Tags</h3>
            </header>
            <ul class="list-inline">
              @if(  !empty($postPopularTags) )
                  @foreach( $postPopularTags as $postPopularTag => $value )
                      <li class="list-inline-item">
                        <a href="{{route('home.tag',$postPopularTag)}}" class="tag">{{ $postPopularTag }}</a>
                      </li>
                  @endforeach
              @else
                  <li class="list-inline-item"><a href="#" class="tag">#No Tags</a></li>
              @endif
            </ul>
          </div>
        </aside>

<script type="text/javascript">

$(document).ready(function() {
  //sidebar search function ajax
   $("#search-input").keyup(function() {
       var keyword = $('#search-input').val();
       var url = "{{route('home.ajax_search')}}";
       if (keyword == "") {
           $("#searchResults").html("");
           $('#searchResults').hide();
       }else {
           $.ajax({
               type: "GET",
               url: url ,
               data: {
                   keyword: keyword
               },
               success: function(data) {
                   $("#searchResults").html(data).show();
                   //console.log(data
               }
           });
           
       }

   });
});



</script>        