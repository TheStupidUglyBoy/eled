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


		            	<form method="POST" action="{{route('page.home.update',$HomePage)}}" enctype="multipart/form-data">
		            	@csrf
		            	@method('PATCH')

		            		<div class="form-group">
			            		<label for="heading">heading</label>
			                    <input type="text" class="form-control form-control-user" 
			                      name="heading" id="heading" placeholder="Enter Heading" value="{{$HomePage->heading}}">
		                    </div>

		            		<div class="form-group">
			            		<label for="introduction_title">Introduction Title</label>
			                    <input type="text" class="form-control form-control-user" 
			                      name="introduction_title" id="introduction_title" placeholder="Enter Introduction Title" value="{{$HomePage->introduction_title}}">
		                    </div>

		                    <div class="form-group">
		                      <label for="introduction">Introduction</label>
		                      <textarea class="form-control" id="introduction" name="introduction" rows="10" cols="50"  required="required">{{$HomePage->introduction}}</textarea>
		                    </div>

		                    <div class="form-group">
			            		<label for="about">about</label>
			                    <input type="text" class="form-control form-control-user" 
			                      name="about" id="about" placeholder="About US" value="{{$HomePage->about}}">
		                    </div>

		                    <div class="form-group">
			            		<label for="subscribe_new_letter">subscribe_new_letter</label>
			                    <input type="text" class="form-control form-control-user" 
			                      name="subscribe_new_letter" id="subscribe_new_letter" placeholder="Subscribe Newsletter" value="{{$HomePage->subscribe_new_letter}}">
		                    </div>

		                    <div class="form-group">
							    <label for="heading_background">Upload Heading Backgroud Image</label>
							    <input type="file" class="form-control-file" id="heading_background" name="heading_background">
							</div>

							<div class="form-group">
							    <label for="thumb_nail_image">Upload About Background Image</label>
							    <input type="file" class="form-control-file" id="about_backgroud" name="about_backgroud">
							</div> 

		            		
		                    <button type="submit" class="btn btn-primary btn-user btn-block">Create</button>
		            	</form>


		            </div>
		        </div>
	      	</div>

	      	<div class="col-6">
	      		
	      			<form method="POST" action="{{route('page.home.changetodefaultimage',$HomePage)}}">
		            	@csrf
		            	@method('PATCH')
		            	<input type="hidden" name="heading_background_image" value="hero.jpg">
		            	<h6>
		            		Not Like your new home page heading background iamge click below to revert back to orignal
		            	</h6>
		                    <button type="submit" class="btn btn-primary btn-user btn-block">Change heading background image Now</button>
	            	</form>

	            	<form method="POST" action="{{route('page.home.changetodefaultimage',$HomePage)}}">
		            	@csrf
		            	@method('PATCH')
		            	<input type="hidden" name="about_background_image" value="divider-bg.jpg">
		            	<h6>
		            		Not Like your new home page about background iamge click below to revert back to orignal
		            	</h6>
		                    <button type="submit" class="btn btn-primary btn-user btn-block">Change about background iamge Now</button>
	            	</form>

	      	</div>
	      </div>
          
        </div>


@endsection

</x-admin.master-admin>