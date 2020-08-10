<x-admin.master-admin>
@section('page.title', $page_title ?? 'eled commnity'   )


@section('page.content')

@if (  $posts->isNotEmpty()   )
    
    	<div class="container-fluid">
	      <h1 class="h3 mb-2 text-gray-800">{{ $page_title ?? 'eled commnity'   }}</h1>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">{{  $page_title ?? 'eled commnity'   }}</h6>
            </div>
            <div class="card-body">
              @include('includes.notification_msg')
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Title</th>
                      <th>Description</th>
                      <th>Post Status</th>
                      <th>Created At</th>
                      <th>Author</th>
                      <th>Restore</th>
                      <th>Delete</th>


                    </tr>
                  </thead>

                  <tbody>
                    
                  	@foreach ($posts as $post)
                    @can('view', $post)
					          <tr>
                      <td>{{ $post->id }}</td>
                      <td><a href="#"> {{ $post->title }}</a> </td>
                      <td> {{ Str::limit($post->description, 20)  }} </td>
                      <td> {{ $post->is_active }} </td>
                      <td>{{ $post->created_at->diffForHumans()  }}</td>
                      <td><a href="#">  {{ empty($post->user->username) ? "No Author"  :  $post->user->username }} </a> </td>
                      <td>    
                      	<form method="POST" action="{{route('restore_trash_post', $post->id)}}">
                      		@csrf
		            		@method('PUT')
                      		<button class="btn btn-primary" type="submit">Restore</button>	
                      	</form>
                      </td>
                      <td> 
                      	<form method="POST" action="{{route('delete_trash_post', $post->id)}}">
                      		@csrf
		            		@method('DELETE')
                      		<button class="btn btn-danger" type="submit">DELETE Permanently</button>	
                      	</form>
                      </td>
                    </tr>
                    @endcan
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


