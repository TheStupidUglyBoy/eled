<x-admin.master-admin>
@section('page.title',  $page_title ?? 'eled commnity' )



@section('style')

@endsection

@section('page.content')

    	<div class="container-fluid">
	      <h1 class="h3 mb-2 text-gray-800">{{ $page_title ?? 'eled commnity'  }} </h1>

	      <div class="row">
	      	<div class="col-6">
	      		<div class="card shadow mb-4">
		            <div class="card-header py-3">
		              <h6 class="m-0 font-weight-bold text-primary">{{ $page_title ?? 'eled commnity'  }} </h6>

		            </div>
		            <div class="card-body">
		            	@include('includes.notification_msg')

		            	<form action="{{route('video.store')}}" method="POST" enctype="multipart/form-data">
      					@csrf
      						<label for='video'>Upload Video</label>
      						<div class="form-group">
		                      <input type="file" id='video' class="form-control" name="video" >
		                    </div>
		            		
		                    <button type="submit" class="btn btn-primary btn-user btn-block">Create</button>

      					</form>


      					

		            </div>
		        </div>
	      	</div>
	      </div>
          
        </div>


@endsection

@section('script')

@endsection
</x-admin.master-admin>