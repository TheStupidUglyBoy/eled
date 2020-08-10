<x-admin.master-admin>
@section('page.title',$page_title)


@section('page.content')

@if (  $users->isNotEmpty()   )
    
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
                      <th>Username</th>
                      <th>Email</th>
                      <th>Role</th>
                      <th>Is Active</th>
                      <th>Company</th>
                      <th>Action</th>
                      <th>Miscellaneous</th>

                    </tr>
                  </thead>

                  <tbody>
                    
                  	@foreach ($users as $user)
					          <tr>
                      <td>{{ $user->id }}</td>
                      <td><a href="{{route('admin_user.edit',$user->id)}}"> {{ $user->username }}</a> </td>
                      <td>{{ $user->email }} </td>
                      <td> {{ $user->role->name ?? "Base User" }}  </td>
                      <td> {{ $user->is_active }} </td>
                      <td>{{ $user->company->name ?? "" }}</td>
                      <td>
                        <form method="POST" action="{{route('admin_approval_action' )}}">
                          @csrf
                          <input type="hidden" name="id"  value = "{{ $user->id }}"  >
                          <input type="hidden" name="model" value = 'user' >
                          @php 
                          if( $user->isActive($user) ){
                            $btn_text = 'Inactive User';
                          }else{
                            $btn_text = 'Active User';
                          }
                          @endphp
                            <button class="btn btn-primary" type="submit">{{ $btn_text }}</button>

                        </form>
                      </td>

                      <td>
                          <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              More Infor
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <p>sign up ip :{{ $user->signup_ip  ?? "" }} </p>
                              <p>Name : {{ $user->first_name }} ,  {{ $user->last_name }}  </p>
                              <p>type : {{ $user->user_type }} </p>
                              <p>created at : {{ $user->created_at->diffForHumans()  }} </p>
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


