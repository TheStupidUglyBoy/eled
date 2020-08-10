<x-admin.master-admin>
@section('page.title',  $page_title ?? 'eled commnity' )



@section('style')
<link rel="stylesheet" href="{{asset('assets/css/dropzone.css')}}">
@endsection

@section('page.content')

    	<div class="container-fluid">
	      <h1 class="h3 mb-2 text-gray-800">{{ $page_title ?? 'eled commnity'  }} </h1>

	      <div class="row">
	      	<div class="col-12">
	      		<div class="card shadow mb-4">
		            <div class="card-header py-3">
		              <h6 class="m-0 font-weight-bold text-primary">{{ $page_title ?? 'eled commnity'  }} </h6>
		              <?php echo ini_get('upload_max_filesize'); ?>
		              <?php echo ini_get('post_max_size'); ?>
		              <?php echo ini_get('memory_limit'); ?>
		            </div>
		            <div class="card-body">
		            	@include('includes.notification_msg')

		            	<form action="{{route('gallery.store')}}" class="dropzone" id="my-awesome-dropzone">
      					@csrf

      					</form>


      					

		            </div>
		        </div>
	      	</div>
	      </div>
          
        </div>


@endsection

@section('script')
<script src="{{asset('assets/js/dropzone.js')}}" ></script>
@endsection
</x-admin.master-admin>