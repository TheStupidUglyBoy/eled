<x-admin.master-admin>
@section('page.title',$page_title)


@section('page.content')

@if (  $tips->isNotEmpty()   )
    
    	<div class="container-fluid">
	      <h1 class="h3 mb-2 text-gray-800">{{$page_title}}</h1>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">{{$page_title}}</h6>
            </div>
            <div class="card-body">
              @include('includes.notification_msg')
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>User</th>
                      <th>Question</th>
                      <th>Answer</th>
                      <th>Created At</th>

                      <th>Action</th>

                    </tr>
                  </thead>

                  <tbody>
                    
                  	@foreach ($tips as $tip)
                    @can('view', $tip)
					          <tr>
                      <td>{{ $tip->id }}</td>
                      <td><a href="#">  {{ empty($tip->user->username) ? "No Author"  :  $tip->user->username }} </a> </td>
                      @can('update', $tip)
                      <td><a href="{{route('tip.edit',$tip)}}"> {{ $tip->question }}</a></td>
                      @endcan
                      @cannot('update', $tip)
                      <td>{{ $tip->question }}</td>
                      @endcan
                      <td>{{ Str::limit($tip->answer, 20)  }}   </td>
                      <td>{{ $tip->created_at->diffForHumans()  }}</td>
                      <td>
                      @can('delete', $tip)  
                          <form method="POST" action="{{route('tip.destroy', $tip)}}">
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


