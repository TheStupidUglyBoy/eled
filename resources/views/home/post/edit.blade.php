<x-home.master-home>
@section('page.title',  $page_title ?? 'eled commnity'  )


@section('style')
	<link href="{{asset('assets/css/tagsinput.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('app/css/summernote.min.css')}}">

@endsection

@section('page.content')

     	<div class="container-fluid">
	      <div class="row">
	      	<div class="col-12">
	      		<h1 class="text-center h3 my-3 text-gray-800 text-success">{{  $page_title ?? 'eled commnity'   }}</h1>
	      		@include('includes.notification_msg')
	      	</div>
	      </div>	 <!-- end of row-->
	      <div class="row my-4">
	      	<div class="col-6">

            	<form method="POST" action="{{route('home.post.update', $post)}}" enctype="multipart/form-data" id="update-post-form">
            	@csrf
            	@method('PATCH')
            		<div class="form-group">
                      <input type="text" class="form-control" name="title" value="{{$post->getAttributes()['title']}}" >
                    </div>
            		
                	<div class="form-group">
						<label for="category_id">Select Category:</label>		
						<select class="form-control" id="category_id" name="category_id" required>
							<option value="{{$post->category->id}}" selected="selected">
								{{$post->category->name}}
							</option>
						@foreach ($categories as $key => $value )
							<option value="{{$key}}"> {{$value}}</option>
						@endforeach
						</select>
					</div> 

                    <div class="form-group">
						<label for="tag">Tag:</label>
						<span class="text-warning">Add tags to describe what your post is about</span>
						<input type="text" id='tag' class="form-control" name="tag" placeholder="Enter Tag"
						value="{{$post->tagList}}" required 
						data-role="tagsinput" >
					</div>

                    <hr>
                    <div class="form-group">
                      <textarea class="form-control" id="editor" name="description" rows="10" cols="50" >{!!    clean($post->getAttributes()['description'])   !!}</textarea>
                    </div>
                    <hr>

                    <div class="form-group">
						<label for="">Uploaded Post ThumbNail</label>
						@if (  $post->image->isNotEmpty()   )
							@foreach ( $post->image as $image  )  
								<img src="{{$image->name}}" width='100' height="100" /> 
							@endforeach 
						@endif
					</div>

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
		                      <input type="text" class="form-control" name="name" placeholder="Enter Product Name" 
		                      value="{{$post->product->name ?? '' }}">
		                    </div>

							<div class="form-group">
							  <label for="brand_name">Brand:</label>
		                      <input type="text" class="form-control" name="brand_name" placeholder="Enter Product Brand" value="{{$post->product->brand_name ?? '' }}">
		                    </div>

		                    <div class="form-group">
							  <label for="model">Model:</label>
		                      <input type="text" class="form-control" name="model" placeholder="Enter Product Model" value="{{$post->product->model ?? '' }}">
		                    </div>

		                    <div class="form-group">
							  <label for="input_power">Input Power:</label>
		                      <input type="text" class="form-control" name="input_power" placeholder="Enter Product Input Power" value="{{$post->product->input_power ?? '' }}">
		                    </div>

		                    <div class="form-group">
							  <label for="input_voltage">Input Voltage:</label>
		                      <input type="text" class="form-control" name="input_voltage" placeholder="Enter Product Input Voltage" value="{{$post->product->input_voltage ?? '' }}">
		                    </div>

		                    <div class="form-group">
							  <label for="working_frequency">Working Frequency:</label>
		                      <input type="text" class="form-control" name="working_frequency" placeholder="Enter Working Frequency" value="{{$post->product->working_frequency ?? '' }}">
		                    </div>

		                    <div class="form-group">
							  <label for="lumen">Lumen:</label>
		                      <input type="text" class="form-control" name="lumen" placeholder="Enter lumen" value="{{$post->product->lumen ?? '' }}">
		                    </div>

		                    <div class="form-group">
							  <label for="cct">CCT:</label>
		                      <input type="text" class="form-control" name="cct" placeholder="Enter CCT" value="{{$post->product->cct ?? '' }}">
		                    </div>

		                    <div class="form-group">
							  <label for="cri">CRI:</label>
		                      <input type="text" class="form-control" name="cri" placeholder="Enter CRI" value="{{$post->product->cri ?? '' }}">
		                    </div>

		                    <div class="form-group">
							  <label for="life_span">Life Span:</label>
		                      <input type="text" class="form-control" name="life_span" placeholder="Enter Life Span" value="{{$post->product->life_span ?? '' }}">
		                    </div>

		                    <div class="form-group">
							  <label for="size">Size:</label>
		                      <input type="text" class="form-control" name="size" placeholder="Enter Size" value="{{$post->product->size ?? '' }}">
		                    </div>

		                    @if(  is_null($post->product) )
		                    <hr>
			                    <div class="form-check">
								  <input class="form-check-input" type="checkbox" value="1" id="confirm_add_product_to_post" name="confirm_add_product_to_post">
								  <label class="form-check-label" for="confirm_add_product_to_post">
								    Link Product Information To Post
								  </label>
								  <small id="confirm_add_product_to_post" class="form-text text-danger">
									  Please select this option if you want to add product information to post
								  </small>
								</div>

							<hr>
							@endif
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
<script type="text/javascript">
	$(document).ready(function() {
		$('#editor').each(function(){
		      var summernote = $(this);
		      $('form').on('submit',function(){
		          if (summernote.summernote('isEmpty')) {
		               summernote.val('');
		          }else if(summernote.val()=='<p><br></p>'){
		               summernote.val('');
		          }
		     });
		 });

	});
</script>
<script src="{{asset('app/js/jquery.validate.js')}}" ></script>
<script src="{{asset('js/validation.js')}}" ></script>


@endsection
</x-home.master-home>