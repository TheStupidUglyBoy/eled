<x-home.master-home>
@section('page.title',  $page_title ?? 'eled commnity'  )


@section('style')
    <link rel="stylesheet" href="{{asset('css/create_post.css')}}" >
@endsection

@section('page.content')

     	<div class="container-fluid">
	      <div class="row">
	      	<div class="col-12">
      			<h1 class="text-center h3 my-3 text-gray-800">{{  $page_title ?? 'eled commnity'   }}</h1>
      			<span class="d-none" id="upload_image_url">{{ route('post.upload_image') }}</span>
      			@include('includes.notification_msg')
	      	</div>
	      </div>	 <!-- end of row-->
	      <div class="row my-4">
	      	<div class="col-6">

            	<form method="POST" action="{{route('home.post.store')}}" enctype="multipart/form-data" id="create-post-form">
            	@csrf
            		<div class="form-group">
                      <input type="text" class="form-control" name="title" placeholder="Enter Post Title">
                    </div>
            		
            		

                	<div class="form-group">
                      <label for="category_id">Select Category:</label>		
                      	<select class="form-control" id="category_id" name="category_id">
							<option value="" selected="selected">Select Category:</option>
							@foreach ($categories as $key => $value )
							<option value="{{$key}}"> {{$value}}</option>
							@endforeach
						</select>
                    </div> 

                    <div class="form-group">
                      <label for="tag">Tag:</label>
                      <span class="text-warning">Add tags to describe what your post is about</span>
                      <input type="text" id='tag' class="form-control" name="tag" placeholder="Enter Tag"
                      value="" data-role="tagsinput" >
                    </div>

                    <hr>
                    <div class="form-group">
                      <textarea class="form-control" class="ignoreThisClass" id="editor" name="description" rows="10" cols="50" ></textarea>
                    </div>
                    <hr>
                    
                    <div class="form-group">
					    <label for="thumb_nail_image">Upload Post ThumbNail Image</label>
					    <input type="file" class="form-control-file" id="thumb_nail_image" name="thumb_nail_image">
					</div>

					
		      		<div class="form-group ">
				        @captcha<br>
				        <label for="validationCustom01">Captcha :  </label>
						<input type="text" id="captcha" name="captcha" autocomplete="off" class="form-control" placeholder="Type Above Letters and Numbers">
				    </div>

		            
	      	</div>

	      	<div class="col-6">

						<button id="link-product-btn" class="btn btn-success btn-user btn-block">
							Click Here To Add Product Information
						</button>
						<hr>

						<div id="product-inforamtion-form">
							<div class="form-group">
							  <label for="name">Product Name:</label>
		                      <input type="text" class="form-control" name="name" placeholder="Enter Product Name">
		                    </div>

							<div class="form-group">
							  <label for="brand_name">Brand:</label>
		                      <input type="text" class="form-control" name="brand_name" placeholder="Enter Product Brand">
		                    </div>

		                    <div class="form-group">
							  <label for="model">Model:</label>
		                      <input type="text" class="form-control" name="model" placeholder="Enter Product Model">
		                    </div>

		                    <div class="form-group">
							  <label for="input_power">Input Power:</label>
		                      <input type="text" class="form-control" name="input_power" placeholder="Enter Product Input Power">
		                    </div>

		                    <div class="form-group">
							  <label for="input_voltage">Input Voltage:</label>
		                      <input type="text" class="form-control" name="input_voltage" placeholder="Enter Product Input Voltage">
		                    </div>

		                    <div class="form-group">
							  <label for="working_frequency">Working Frequency:</label>
		                      <input type="text" class="form-control" name="working_frequency" placeholder="Enter Working Frequency">
		                    </div>

		                    <div class="form-group">
							  <label for="lumen">Lumen:</label>
		                      <input type="text" class="form-control" name="lumen" placeholder="Enter lumen">
		                    </div>

		                    <div class="form-group">
							  <label for="cct">CCT:</label>
		                      <input type="text" class="form-control" name="cct" placeholder="Enter CCT">
		                    </div>

		                    <div class="form-group">
							  <label for="cri">CRI:</label>
		                      <input type="text" class="form-control" name="cri" placeholder="Enter CRI">
		                    </div>

		                    <div class="form-group">
							  <label for="life_span">Life Span:</label>
		                      <input type="text" class="form-control" name="life_span" placeholder="Enter Life Span">
		                    </div>

		                    <div class="form-group">
							  <label for="size">Size:</label>
		                      <input type="text" class="form-control" name="size" placeholder="Enter Size">
		                    </div>

		                    <hr>
		                    <div class="form-check">
							  <input class="form-check-input" type="checkbox" value=1 id="confirm_add_product_to_post" name="confirm_add_product_to_post">
							  <label class="form-check-label" for="confirm_add_product_to_post">
							    Link Product Information To Post
							  </label>
							  <small id="confirm_add_product_to_post" class="form-text text-danger">
								  Please select this option if you want to add product information to post
							  </small>
							</div>

							<hr>
	                    </div>

		            
	      	</div>




	      </div>  <!-- end of row-->

	      <div class="row my-4">


	      		<button type="submit" class="btn btn-success btn-block">Create</button>
	      	</form>
	      </div>  <!-- end of row-->
	      

        </div>  <!-- end of container -->





@endsection


@section('script')
<script src="{{asset('assets/js/tagsinput.js')}}" ></script>
<script  src="{{asset('app/js/summernote.min.js')}}"></script>
<script src="{{asset('js/create_post.js')}}" type="text/javascript" ></script>

<script src="{{asset('app/js/jquery.validate.js')}}" ></script>
<script src="{{asset('js/validation.js')}}" ></script>
@endsection
</x-home.master-home>