<x-admin.master-admin>
@section('page.title', $page_title ?? 'eled commnity'  )

@section('page.content')

@if (  $categories->isNotEmpty()   )
    
    	<div class="container-fluid">
	      <h1 class="h3 mb-2 text-gray-800">{{ $page_title ?? 'eled commnity'  }}</h1>


          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">{{ $page_title ?? 'eled commnity'  }}</h6>
            </div>
            <div class="card-body">
              <h4 class="text-danger">
              When Category is deleted , all posts under category will be removed entirely.
              Please take note .thanks
              </h4>
              @include('includes.notification_msg')
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Created At</th>
                      <th>Delete</th>
                    </tr>
                  </thead>

                  <tbody>
                    
                  	@foreach ($categories as $category)
					           <tr>
                      <td>{{ $category->id }}</td>
                      <td><a href="{{route('category.edit',$category)}}"> {{ $category->name }}</a> </td>
                      <td>{{ $category->created_at->diffForHumans()  }}</td>

                      <td>
                      	<form method="POST" action="{{route('category.destroy', $category)}}">
                      		@csrf
		            		@method('DELETE')
                      		<button class="btn btn-danger" type="submit">DELETE</button>	
                      	</form>
                      </td>
                    </tr>
					@endforeach
                   </tbody>

                </table>
              </div> 
            </div>
           </div>
        </div>
@else
    <h4>No Data Available</h4>
@endif

@endsection


@section('script')

<script src="{{asset('assets/js/datatable/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatables-demo.js')}}"></script> 


@endsection


</x-admin.master-admin>


