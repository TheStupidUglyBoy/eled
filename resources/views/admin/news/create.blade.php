<x-admin.master-admin>
@section('page.title', $page_title ?? 'eled commnity'  )

@section('style')
  <link rel="stylesheet" href="{{asset('app/css/summernote.min.css')}}">
@endsection

@section('page.content')

    	<div class="container-fluid">
	      <h1 class="h3 mb-2 text-gray-800">{{ $page_title ?? 'eled commnity'  }}</h1>

	      <div class="row">
	      	<div class="col-12">
	      		<div class="card shadow mb-4">
		            <div class="card-header py-3">
		              <h6 class="m-0 font-weight-bold text-primary">{{ $page_title ?? 'eled commnity'  }}</h6>
		            </div>
		            <div class="card-body">
		            	@include('includes.notification_msg')


		            	<form method="POST" action="{{route('news.store')}}" enctype="multipart/form-data">
		            	@csrf
		            		<div class="form-group">
		                      <input type="text" class="form-control" name="title" placeholder="Enter News Title">
		                    </div>
		            		
		            		<div class="form-group">
		                      <textarea class="form-control" id="editor" name="body" rows="10" cols="50" ></textarea>
		                    </div>


		                    <div class="form-group">
							    <label for="image">upload image</label>
							    <input type="file" class="form-control-file" id="image" name="image">
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

<script  src="{{asset('app/js/summernote.min.js')}}"></script>
<script type="text/javascript">
	$(document).ready(function() {

        $('#editor').summernote({
        	placeholder: 'Create Your News Now',
	        tabsize: 2,
	        height: 300,
	        toolbar: [
			  ['style', ['style']],
			  ['font', ['bold', 'underline', 'clear']],
			  ['fontname', ['fontname']],
			  ['color', ['color']],
			  ['para', ['ul', 'ol', 'paragraph']],
			  ['insert', ['link']],
			  ['view', ['fullscreen', 'codeview', 'help']],
			]
        });
    });
</script>
@endsection


</x-admin.master-admin>