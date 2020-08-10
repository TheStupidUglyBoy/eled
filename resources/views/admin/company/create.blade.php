<x-admin.master-admin>
@section('page.title', $page_title ?? 'eled commnity'  )


@section('page.content')

    	<div class="container-fluid">
	      <h1 class="h3 mb-2 text-gray-800">{{ $page_title ?? 'eled commnity'  }}</h1>

	      <div class="row">
	      	<div class="col-12">
	      		<div class="card shadow mb-4">
		            <div class="card-header py-3">
		              <h6 class="m-0 font-weight-bold text-primary">{{ $page_title ?? 'eled commnity'  }}</h6>
		            </div>
		            <div class="card-body">
		            	@include('includes.notification_msg')


		            	<form method="POST" action="{{route('admin.company.store')}}" >
		            	@csrf
		                    <div class="form-group">
		                      <label for="name">Company Name:</label>
		                      <input type="text" class="form-control" name="name"
		                       value="" required placeholder="Input Your Company Name">
		                    </div>

		                    <div class="form-group">
		                      <label for="name">Company Website:</label>
		                      <input type="text" class="form-control" name="website" placeholder="Etc : https://google.com" >
		                    </div>

		                    <div class="form-group">
		                      <label for="name">Contact Number:</label>
		                      <input type="text" class="form-control" name="contact_number" id="contact_number"
		                       value="" placeholder="Etc : 13790450900" >
		                    </div>

		                    <div class="form-group">
		                      <label for="location">Location</label>   
		                      <input type="text" class="form-control" name="location" placeholder="Input your company location" required>
		                    </div>

		                    <div class="form-group">
		                      <label for="about">About Comapany:</label>
		                      <textarea class="form-control" placeholder="tell us your company about" name="about" id="about" rows="3"></textarea>
		                    </div>
		                    <button type="submit" class="btn btn-success btn-block">Create</button>
		            	</form>
		            </div>
		        </div>
	      	</div>
	      </div>
          
        </div>


@endsection




</x-admin.master-admin>