<x-admin.master-admin>
@section('page.title',  $page_title ?? 'eled commnity'   )


@section('page.content')

@if (  $posts->isNotEmpty()   )
    
    	<div class="container-fluid">
	      <h1 class="h3 mb-2 text-gray-800">{{ $page_title ?? 'eled commnity'   }}</h1>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">{{ $page_title ?? 'eled commnity'   }}</h6>
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
                      <th>Category</th>
                      <th>Post Status</th>
                      <th>Created At</th>
                      <th>Author</th>
                      <th>Image</th>
                      <th>Delete</th>
                      @if (  auth::user()->allowAdminEditor()   )
                      <th>Approval</th>
                      @endif
                    </tr>
                  </thead>

                  <tbody>
                    
                  	@foreach ($posts as $post)
                    @can('view', $post)
					          <tr>
                      <td>{{ $post->id }}</td>

                      @can('update', $post)
                      <td><a href="{{route('post.edit',$post)}}"> {{ Str::limit($post->title,20 )}}</a> </td>
                      @endcan
                      @cannot('update', $post)
                      <td>{{ $post->title }}</td>
                      @endcan
                      
                      <td> {{ Str::limit($post->description, 20)  }} </td>
                      <td>{{ empty($post->category->name) ? "No Category"  :  $post->category->name }}  </td>
                      <td> {{ $post->is_active }} </td>
                      <td>{{ $post->created_at->diffForHumans()  }}</td>
                      <td> {{ empty($post->user->username) ? "No Author"  :  $post->user->username }} </td>
                      <td>   <img src="{{$post->get_post_thumb_nail($post)}}" width="30" height="30">   </td>
                      <td>
                        @can('delete', $post)
                      	<form method="POST" action="{{route('post.destroy', $post->id)}}">
                      		@csrf
		            		      @method('DELETE')
                      		<button class="btn btn-danger" type="submit">DELETE</button>	
                      	</form>
                        @endcan
                        @if( !$post->isActive($post) )
                            <a href="{{route('preview.post',$post)}}" class='btn btn-link'>preview</a> 
                        @endif
                      </td>
                      @if(auth::user()->allowAdminEditor() )
                      <td>
                        <form method="POST" action="{{route('admin_approval_action' )}}">
                          @csrf
                          <input type="hidden" name="id"  value = "{{ $post->id }}"  >
                          <input type="hidden" name="model" value = 'post' >
                          @if( $post->is_active == 'Approved')
                            <input type="hidden" name="action" value = 0 >
                            <button class="btn btn-primary" type="submit">Draft It</button> 
                          @else
                            <input type="hidden" name="action" value = 1 >
                            <button class="btn btn-primary" type="submit">Approve It</button>
                          @endif
                        </form>
                            
                      </td>
                      @endif

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


