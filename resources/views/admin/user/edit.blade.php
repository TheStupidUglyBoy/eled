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
		            	<form method="POST" action="{{route('admin_user.update', $user)}}">
		            	@csrf
		            	@method('PATCH')
		            		<div class="form-group">
		            		  <label for="username">UserName:</label>		
		                      <input type="text" class="form-control" name="username" placeholder="Enter Username" value="{{$user->username}}">
		                    </div>
		            		
		            		<div class="form-group">
		            		  <label for="first_name">First Name:</label>	
		                      <input type="text" class="form-control" name="first_name" placeholder="Enter First Name" value="{{$user->first_name}}">
		                    </div>

		                    <div class="form-group">
		                      <label for="last_name">Last Name:</label>	
		                      <input type="text" class="form-control" name="last_name" placeholder="Enter Last Name" value="{{$user->last_name}}">
		                    </div>

		                    <div class="form-group">
		                      <label for="email">Email Address:</label>		
		                      <input type="email" class="form-control" name="email" placeholder="Enter Email" value="{{$user->email}}">
		                    </div>

		                    <div class="form-group">
		                      <label for="select_role">Select Role:</label>		
		                      	<select class="form-control" id="select_role" name="role_id">
									<option 
									value="{{$user->role_id ?? '' }}" selected="selected">
									{{$user->role->name ?? 'Base User' }}
									</option>
									@foreach ($get_roles_from_composer as $key => $value )
									<option value="{{$key}}"> {{$value}}</option>
									@endforeach
									<option value=""> Base User </option>
								</select>
		                    </div>

		                    <div class="form-group">
		                      <label for="company_id">Select Company:</label>		
		                      	<select class="form-control" id="company_id" name="company_id" >
									<option value="{{$user->company->id ?? '' }}" selected="selected">
										{{ $user->company->name ?? "No Company" }}
									</option>
									@foreach ($companies_list as $key => $value )
										<option value="{{$key}}"> {{$value}}</option>
									@endforeach
									<option value=""> Unassigned </option>
								</select>
		                    </div>

		                    <button type="submit" class="btn btn-primary btn-user btn-block">Update</button>
		            	</form>

		            </div>
		        </div>
	      	</div>
	      </div>
          
        </div>


@endsection

</x-admin.master-admin>