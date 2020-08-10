<x-admin.master-admin>
@section('page.title',$page_title)


@section('page.content')

    	<div class="container-fluid">
	      <h1 class="h3 mb-2 text-gray-800">{{$page_title}}</h1>

	      <div class="row">
	      	<div class="col-6">
	      		<div class="card shadow mb-4">
		            <div class="card-header py-3">
		              <h6 class="m-0 font-weight-bold text-primary">{{$page_title}}</h6>

		            </div>
		            <div class="card-body">
		            	@include('includes.notification_msg')

		            	<h6 class="m-0 font-weight-bold text-primary">Internal User are default activated without sending email verification</h6>
		            	<form method="POST" action="{{route('admin_user.store')}}">
		            		@csrf
		            		<div class="form-group">
		            		  <label for="username">UserName:</label>		
		                      <input type="text" class="form-control" name="username" placeholder="Enter Username">
		                    </div>
		            		
		            		<div class="form-group">
		            		  <label for="first_name">First Name:</label>	
		                      <input type="text" class="form-control" name="first_name" placeholder="Enter First Name">
		                    </div>

		                    <div class="form-group">
		                      <label for="last_name">Last Name:</label>	
		                      <input type="text" class="form-control" name="last_name" placeholder="Enter Last Name">
		                    </div>

		                    <div class="form-group">
		                      <label for="email">Email Address:</label>		
		                      <input type="email" class="form-control" name="email" placeholder="Enter Email">
		                    </div>

		                    <div class="form-group">
		                      <label for="password">Pssword:</label>		
		                      <input type="password" class="form-control" name="password" placeholder="Enter Password">
		                    </div>

		                    <div class="form-group">
		                      <label for="password_confirmation">Confirm Pssword:</label>		
		                      <input type="password" class="form-control" name="password_confirmation" placeholder="Enter Password">
		                    </div>

		                    <div class="form-group">
		                      <label for="select_role">Select Role:</label>		
		                      	<select class="form-control" id="select_role" name="role_id" required>
									<option value="" selected="selected" disabled>Select Role:</option>
									@foreach ($get_roles_from_composer as $key => $value )
									<option value="{{$key}}"> {{$value}}</option>
									@endforeach
									<option value=""> Base User </option>
								</select>
		                    </div>

		                    <div class="form-group">
		                      <label for="company_id">Select Company:</label>		
		                      	<select class="form-control" id="company_id" name="company_id" >
									<option value="" selected="selected" disabled>Select Company :</option>
									@foreach ($companies_list as $key => $value )
										<option value="{{$key}}"> {{$value}}</option>
									@endforeach
									<option value=""> Unassigned </option>
								</select>
		                    </div>


		                    <button type="submit" class="btn btn-primary btn-user btn-block">Create</button>
		            	</form>
		            </div>
		        </div>
	      	</div>
	      </div>
          
        </div>


@endsection
</x-admin.master-admin>