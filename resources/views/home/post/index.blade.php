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
                <h1 class="text-break" >{{ $post->getAttributes()['title'] }}</h1>
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

                <div class="post-body text-break">
                  {!!    clean($post->getAttributes()['description'])   !!}
                </div>
                
                <div class="post-tags">
                  @if(  !empty($post->tagArray) )
                      @foreach( $post->tagArray as $post_tag)
                          <a href="{{route('home.tag',$post_tag)}}" class="tag">#{{  $post_tag }}</a>
                      @endforeach
                  @else
                      <h4 class="text-warning">No Tags For This Post</h4> 
                  @endif
                </div>


                @if( !is_null($post->product) )
                <div class="my-5 table-responsive">
                  <p class="h1 theme-color">Product Specification</p>
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Brand</th>
                        <th scope="col">Model</th>
                        <th scope="col">Input Power</th>
                        <th scope="col">Input Voltage</th>
                        <th scope="col">Working Frequency</th>
                        <th scope="col">Lumen</th>
                        <th scope="col">CCT</th>
                        <th scope="col">CRI</th>
                        <th scope="col">Life Span</th>
                        <th scope="col">Size</th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr>
                          <td> {{ $post->product->name }} </td>
                          <td> {{ $post->product->brand_name }} </td>
                          <td> {{ $post->product->model }} </td>
                          <td> {{ $post->product->input_power }} </td>
                          <td> {{ $post->product->input_voltage }} </td>
                          <td> {{ $post->product->working_frequency }} </td>
                          <td> {{ $post->product->lumen }} </td>
                          <td> {{ $post->product->cct }} </td>
                          <td> {{ $post->product->cri }} </td>
                          <td> {{ $post->product->life_span }} </td>
                          <td> {{ $post->product->size }} </td>
                        </tr>

                    </tbody>
                  </table>
                </div>  
                @endif

                <!-- display comments -->
                <x-home.comment-home :comments="$comments" :post="$post" />
              
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
  
$(document).ready(function(){
  $(".edit-comment-form-link").click(function(){

    var comment_id           = $(this).attr('data-edit-link-id');
    var display_comment_body = $("[id*='display-comment-id-" + comment_id + "']");
    var edit_comment_form    = $("[id*='edit-comment-form-id-" + comment_id + "']");

    if( edit_comment_form.is(":visible") && display_comment_body.is(":hidden") ){
      //hide edit form show comment body
      display_comment_body.show();
      edit_comment_form.hide();
      $(this).text("edit");
    } else{
      //show edit form hide comment body
      display_comment_body.hide();
      edit_comment_form.show();
      $(this).text("cancel");
    }
    
  });



});

</script>

@endsection
</x-home.master-home>