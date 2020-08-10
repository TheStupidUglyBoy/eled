<x-home.master-home>
@section('page.title',$page_title)


@section('page.content')



<div class="row">
  <div class="col-md-6 offset-md-3">
  	<div class="my-5 py-5" >
  		<div class="col-md-6 offset-md-3">
  			@include('includes.notification_msg')
  			<form method="POST" action="{{route('user.reset_user_password')}}" >
				@csrf
				@method('PATCH')
			    <div class="form-group ">
			    	<input type="hidden" name="email" value="{{$email}}">
			    	<input type="hidden" name="token" value="{{$token}}">
					<div class="form-group">
          				<label class="d-block">Reset Password</label>
          				
          				<input type="password" name="new_password" id="new_password" class="form-control mt-1" placeholder="New password" required>
          				
          				<input type="password" name="new_confirm_password" class="form-control mt-1" placeholder="Confirm new password" required>
          			</div>
			    </div>  
			    
			    <div class="form-group">
			        <button type="submit" class="btn btn-success btn-block"> Reset Now  </button>
			    </div>

			</form>
		</div>

	</div>
  </div>
</div>


@endsection


</x-home.master-home>