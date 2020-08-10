<x-home.master-home>
@section('page.title',$page_title)


@section('page.content')



<div class="row">
  <div class="col-md-6 offset-md-3">
  	<div class="my-5 py-5" >
  		<div class="col-md-6 offset-md-3">
  			@include('includes.notification_msg')
  			<form method="POST" action="{{route('login_process')}}" id="login-form">
				@csrf	
			    <div class="form-group ">
					<label for="validationCustom01">Email :  </label> 	
			        <input name="email" class="form-control" placeholder="Email address" type="email" >

			    </div>  
			    
			    <div class="form-group ">
					<label for="validationCustom01">Password :  </label> 	
			        <input class="form-control" placeholder="Type password" type="password" name="password" >
			    </div>

			    <div class="form-group ">
			        @captcha<br>
			        <label for="validationCustom01">Captcha :  </label>
					<input type="text" id="captcha" name="captcha" autocomplete="off" class="form-control" placeholder="Type Above Letters and Numbers">
			    </div>


			    <div class="form-group">
			        <button type="submit" class="btn btn-success btn-block"> Log In  </button>
			    </div>  
			    <p class="text-center">Not Yet Sign Up ? Click <a href="{{route('create_register')}}">Here</a> </p>  
			    <p class="text-center">Forget Your Password ? Click 
			    	<a class="text-success" href="{{route('user.forget_password')}}">Here</a> to reset
			    </p> 

			</form>
		</div>

	</div>
  </div>
</div>


@endsection

@section('script')
<script src="{{asset('app/js/jquery.validate.js')}}" ></script>
<script src="{{asset('js/validation.js')}}" ></script>


@endsection
</x-home.master-home>