<x-admin.master-admin>
@section('page.title',  $page_title ?? 'eled commnity'   )

@section('page.content')

@if (  $galleries->isNotEmpty()   )
    
    	<div class="container-fluid">
	      <h1 class="h3 mb-2 text-gray-800">{{  $page_title ?? 'eled commnity'  }}</h1>


          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">{{  $page_title ?? 'eled commnity'  }}</h6>
            </div>
            <div class="card-body">
              @include('includes.notification_msg')
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>edit</th>
                      <th>Description</th>
                      <th>Image</th>
                      <th>Created At</th>
                      <th>Delete</th>
                    </tr>
                  </thead>

                  <tbody>
                    
                  	@foreach ($galleries as $gallery)
					<tr>
                      <td><a href="{{route('gallery.edit',$gallery)}}"> edit </a></td>
                      <td> {{ $gallery->description ?? '' }} </td>
                      <td>
                      	<img src="{{ $gallery->get_image($gallery)  }}" width="30" height="30">
                      </td>
                      <td>{{ $gallery->created_at->diffForHumans()  }}</td>

                      <td>
                      	<form method="POST" action="{{route('gallery.destroy', $gallery)}}">
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


