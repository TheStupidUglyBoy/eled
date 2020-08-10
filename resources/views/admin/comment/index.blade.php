<x-admin.master-admin>
@section('page.title',$page_title)


@section('page.content')

@if (  $comments->isNotEmpty()   )
    
    	<div class="container-fluid">
	      <h1 class="h3 mb-2 text-gray-800">{{$page_title}}</h1>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">{{$page_title}}</h6>
              <h5>If post is draft its comment cant be <strong class="text-danger">approve or draft</strong> error 404 will be generated </h5>
            </div>
            <div class="card-body">
              @include('includes.notification_msg')
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Author</th>
                      <th>Body</th>
                      <th>POST</th>
                      <th>POST status</th>
                      <th>Comment Status</th>
                      <th>Created At</th>
                      @if (  auth::user()->allowAdminEditor()   )
                      <th>Action</th>
                      @endif
                    </tr>
                  </thead>

                  <tbody>
                    
                  	@foreach ($comments as $comment)

					          <tr>
                      <td>{{ $comment->id }}</td>
                      <td> {{ empty($comment->user->username) ? "No Author"  :  $comment->user->username }} </td>
                      <td> {{ Str::limit($comment->body, 20)  }} </td>
                      <td>
                        <?php $querystring = $comment->post->slug."#comment-id-$comment->id"; ?>
                        <a href="{{route('home.post', $querystring)}}">
                          {{ empty($comment->post->title) ? "No POST"  : Str::limit($comment->post->title,20) }}  
                        </a> 
                      </td>
                      <td> {{ $comment->post->is_active }} </td>
                      <td> {{ $comment->is_active }} </td>
                      <td>{{ $comment->created_at->diffForHumans()  }}</td>
                      @if(auth::user()->allowAdminEditor() )
                      <td>
                        <form method="POST" action="{{route('admin_approval_action' )}}">
                          @csrf
                          <input type="hidden" name="id"  value = "{{ $comment->id }}"  >
                          <input type="hidden" name="model" value = 'comment' >
                          @if( $comment->is_active == 'Approved')
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


