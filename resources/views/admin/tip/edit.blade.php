<x-admin.master-admin>
@section('page.title',$page_title)

@section('style')
	<link rel="stylesheet" href="{{asset('app/css/summernote.min.css')}}">
@endsection
@section('page.content')

    	<div class="container-fluid">
	      <h1 class="h3 mb-2 text-gray-800">{{$page_title}}</h1>

	      <div class="row">
	      	<div class="col-12">
	      		<div class="card shadow mb-4">
		            <div class="card-header py-3">
		              <h6 class="m-0 font-weight-bold text-primary">{{$page_title}}</h6>
		            </div>
		            <div class="card-body">
		            	@include('includes.notification_msg')
		            	<form method="POST" action="{{route('tip.update', $tip)}}" enctype="multipart/form-data">
		            	@csrf
		            	@method('PATCH')
		            		<div class="form-group">
		                      <input type="text" class="form-control" name="question" value="{{$tip->question}}">
		                    </div>
		            		
		            		<div class="form-group">
		                      <textarea class="form-control" name="answer" id='editor' rows="4" cols="50" >{{$tip->answer}}</textarea>
		                    </div>
		                    <button type="submit" class="btn btn-primary btn-user btn-block">Update</button>
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
        	placeholder: 'Create Your Tips Now',
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