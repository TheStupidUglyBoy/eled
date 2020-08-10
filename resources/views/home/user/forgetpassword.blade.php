<x-home.master-home>
@section('page.title',$page_title)


@section('page.content')



<div class="row">
  <div class="col-md-6 offset-md-3">
  	<div class="my-5 py-5" >
  		<div class="col-md-6 offset-md-3">
  			@include('includes.notification_msg')
  			<form method="POST" action="{{route('user.reset_password')}}" >
				@csrf	
			    <div class="form-group ">
					<label for="validationCustom01">Email :  </label> 	
			        <input name="email" class="form-control" placeholder="Email address" type="email" required autocomplete="off">

			    </div>  
			    
			    <div class="form-group">
			        <button type="submit" class="btn btn-success btn-block"> Proceed Now  </button>
			    </div>  
			    <p class="text-center">Not Yet Sign Up ? Click <a href="{{route('create_register')}}">Here</a></p> 

			</form>
		</div>

	</div>
  </div>
</div>


@endsection


</x-home.master-home>