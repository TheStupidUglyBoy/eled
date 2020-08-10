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


		            	<form method="POST" action="{{route('category.update', $category)}}">
		            	@csrf
		            	@method('PATCH')
		            		<div class="form-group">
		                      <input type="text" class="form-control form-control-user" name="name" placeholder="Enter Category Name" value="{{$category->name}}">
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