<x-home.master-home>
@section('page.title',$page_title)


@section('page.content')

<div class="row">
  <div class="col-md-6 offset-md-3">
  	<div class="my-3 " >
  		<div class="col-md-6 offset-md-3">
  			@include('includes.notification_msg')
  			<form method="POST" action="{{route('store_register')}}" id="registration-form">
				@csrf

				<div class="form-group ">
					<label for="username">Username :  </label> 	
			        <input name="username" class="form-control" placeholder="Your Username" type="text" required>
			    </div>

			    <div class="form-group ">
					<label for="email">Email :  </label> 	
			        <input name="email" class="form-control" placeholder="Email address" type="email" >
			    </div>

			    <div class="form-group ">
					<label for="first_name">First Name :  </label> 	
			        <input name="first_name" class="form-control" placeholder="Your First Name" type="text">
			    </div>

			    <div class="form-group ">
					<label for="last_name">Last Name :  </label> 	
			        <input name="last_name" class="form-control" placeholder="Your Last Name" type="text">
			    </div>
			    
			    <div class="form-group ">
					<label for="password">Password :  </label> 	
			        <input class="form-control" placeholder="Type password" type="password" name="password" id="password">
			    </div>

			    <div class="form-group ">
			    	<label for="password">Confirm Password :  </label> 
			   		<input class="form-control" placeholder="Repeat password" type="password" name="password_confirmation" >
			   	</div>

			   	<div class="form-group ">
			        @captcha<br>
			        <label for="validationCustom01">Captcha :  </label>
					<input type="text" id="captcha" name="captcha" autocomplete="off" class="form-control" placeholder="Type Above Letters and Numbers">
			    </div>

			    <!-- css loader -->
			    <div class="py-2 d-none loader-warapper"> 
			    	<div class="loader  " id=""></div>
				</div>

			    <div class="form-group">
		        	<button type="submit" class="btn btn-success btn-block"> Create Account  </button>
		    	</div>
			    <p class="text-center">Have Account Already ? Click <a href="{{route('login')}}">Here</a> </p>

				<p>No receive email from us ? click  
					<a  href="" data-toggle="modal" data-target="#resend-email-modal">
				  Here 
					</a> to resend
				</p>
			</form>
		</div>

	</div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="resend-email-modal" tabindex="-1" aria-labelledby="resend-email-modal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="resend-email-modal">Token Expired or Did not receive email</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	  	<form method="POST" action="{{route('user.resend_veirification_email')}}" id="">
				@csrf
				<div class="form-group ">
					<label for="email">Email :  </label> 	
			        <input name="email" class="form-control" placeholder="Your Username" type="email" required>
			    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Proceed</button>
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