<x-admin.master-admin>
@section('page.title', $page_title ?? 'eled commnity'  )


@section('page.content')

    	<div class="container-fluid">
	      <h1 class="h3 mb-2 text-gray-800">{{$page_title ?? 'eled commnity' }}</h1>

	      <div class="row">
	      	<div class="col-6">
	      		<div class="card shadow mb-4">
		            <div class="card-header py-3">
		              <h6 class="m-0 font-weight-bold text-primary">{{$page_title ?? 'eled commnity' }}</h6>
		            </div>
		            <div class="card-body">
		            	@include('includes.notification_msg')


		            	<form method="POST" action="{{route('gallery.update', $gallery)}}">
		            	@csrf
		            	@method('PATCH')


		                    <div class="form-group">
		                      <textarea class="form-control"  name="description" rows="10" cols="50"  placeholder="Enter Image Description" required="required">{{$gallery->description}}</textarea>
		                    </div>

		                    <div class="form-group">
		            			<img src="{{$gallery->get_image($gallery)}}" width="100" height="100">
		            		</div>
		                    <button type="submit" class="btn btn-primary btn-user btn-block">Create</button>
		            	</form>
		            </div>
		        </div>
	      	</div>
	      </div>
          
        </div>


@endsection

</x-admin.master-admin>