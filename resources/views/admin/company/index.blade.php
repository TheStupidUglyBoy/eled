<x-admin.master-admin>
@section('page.title', $page_title ?? 'eled commnity'  )

@section('page.content')

@if (  $companies->isNotEmpty()   )
    
    	<div class="container-fluid">
	      <h1 class="h3 mb-2 text-gray-800">{{ $page_title ?? 'eled commnity'  }}</h1>


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
                      <th>Name</th>
                      <th>Website</th>
                      <th>Number</th>
                      <th>Location</th>
                      <th>About</th>
                      <th>Active</th>
                      <th>Busiense license</th>
                      <th>Created At</th>
                      <th>Action</th>
                    </tr>
                  </thead>

                  <tbody>
                    
                  	@foreach ($companies as $company)
					          <tr>
                      <td>{{ $company->id }}</td>
                      <td><a href="{{route('admin.company.edit' , $company)}}"> {{ $company->name }}</a> </td>
                      <td> {{ $company->website }} </td>
                      <td> {{ $company->contact_number }} </td> 
                      <td> {{ $company->location }} </td> 
                      <td> {{ $company->about }} </td> 
                      <td> {{ $company->is_active }} </td> 

                      <td>
                        @foreach ( $company->image as $image  )  
                          <a href="{{$image->name}}" target='_blank'> <img src="{{$image->name}}" width='30' height="30" /></a>
                        @endforeach
                      </td>

                      <td>{{ $company->created_at->diffForHumans()  }}</td>

                      <td>
                          <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Action
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <span>
                                  <form method="POST" action="{{route('admin_approval_action' )}}">
                                    @csrf
                                    <input type="hidden" name="id"  value = "{{ $company->id }}"  >
                                    <input type="hidden" name="model" value = 'company' >
                                    @if( $company->is_active == 'Approved')
                                      <input type="hidden" name="action" value = 0 >
                                      <button class="btn btn-primary" type="submit">Draft It</button> 
                                    @else
                                      <input type="hidden" name="action" value = 1 >
                                      <button class="btn btn-primary" type="submit">Approve It</button>
                                    @endif
                                  </form>
                                </span>
                                <span>
                                  <form method="POST" action="{{route('admin.company.destroy', $company)}}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">DELETE</button>  
                                  </form>
                                </span>
                            </div>
                          </div>
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


