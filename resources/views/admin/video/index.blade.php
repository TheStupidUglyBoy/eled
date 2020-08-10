<x-admin.master-admin>
@section('page.title',  $page_title ?? 'eled commnity'   )

@section('page.content')

@if (  $videos->isNotEmpty()   )
    
    	<div class="container-fluid">
	      <h1 class="h3 mb-2 text-gray-800">{{  $page_title ?? 'eled commnity'  }}</h1>


          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">{{  $page_title ?? 'eled commnity'  }}</h6>
            </div>
            <div class="card-body">
              @include('includes.notification_msg')

                    <div class="row">
                  	@foreach ($videos as $video)
                    <div class="col-lg-10">
                      <div class="embed-responsive embed-responsive-21by9">
                        <iframe class="embed-responsive-item" src="{{$video->get_video($video)}}"></iframe>
                      </div>
                    </div>  
                    <div class="col-lg-2">  
                      <form method="POST" action="{{route('video.destroy', $video)}}">
                          @csrf
                          @method('DELETE')
                          <button class="btn btn-danger" type="submit">DELETE</button>  
                        </form>
                      
                    </div>  
					          @endforeach
                    </div>


            </div>
           </div>
        </div>
@else
    <h4>No Data Available</h4>
@endif

@endsection





</x-admin.master-admin>


