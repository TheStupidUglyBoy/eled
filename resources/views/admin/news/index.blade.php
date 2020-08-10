<x-admin.master-admin>
@section('page.title',  $page_title ?? 'eled commnity'   )


@section('page.content')

@if (  $news->isNotEmpty()   )
    
    	<div class="container-fluid">
	      <h1 class="h3 mb-2 text-gray-800">{{ $page_title ?? 'eled commnity'  }}</h1>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">{{ $page_title ?? 'eled commnity'  }}</h6>
            </div>
            <div class="card-body">
              @include('includes.notification_msg')
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>User</th>
                      <th>Title</th>
                      <th>Body</th>
                      <th>Created At</th>
                      <th>Image</th>
                      <th>Action</th>
                    </tr>
                  </thead>

                  <tbody>
                    
                  	@foreach ($news as $new)
                    @can('view', $new)
					          <tr>
                      <td>{{ $new->id }}</td>
                      <td>  {{   $new->user->username ?? "No Author" }}</td>
                      @can('update', $new)
                      <td><a href="{{route('news.edit',$new)}}"> {{ $new->title }}</a> </td>
                      @endcan
                      @cannot('update', $new)
                      <td>{{ $new->title }}</td>
                      @endcan
                      <td> {{ $new->body }} </td>
                      <td>{{ $new->created_at->diffForHumans()  }}</td>
                      <td>
                        @foreach ( $new->image as $image  )  
                          <p> <img src="{{$image->name}}" width='30' height="30" /></p> 
                        @endforeach
                      </td>
                      <td>
                        @can('delete', $new) 
                      	<form method="POST" action="{{route('news.destroy', $new)}}">
                      		@csrf
		            		      @method('DELETE')
                      		<button class="btn btn-danger" type="submit">DELETE</button>	
                      	</form>
                        @endcan
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


