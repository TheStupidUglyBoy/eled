<x-home.master-home>
@section('page.title',  $page_title ?? 'eled commnity'  )


@section('page.content')

     	<div class="container-fluid">
	      <div class="row  my-5">
	      	<div class="col-12">
	      			<h1 class="text-center h3 my-3 text-gray-800">{{  $page_title ?? 'eled commnity'   }}</h1>
	      			@include('includes.notification_msg')
	      	</div>
	      </div>	 <!-- end of row-->
	      <div class="row my-4">

	      	<div class="col-md-6 offset-md-3">

	      		<ul class="list-group list-group-flush">
	                @if (  $posts->count() >= 0    )
	                  @foreach ($posts as $post)
							@php
							    if( $post->getAttributes()['is_active'] == 0  ){
							        $hide_edit_link = '';
							        $disabled_link = 'disabled-link';
							    }else{
							        $hide_edit_link = 'd-none';
							        $disabled_link = '';
							    }
							@endphp

	                     <li class="list-group-item ">

	                        <a href="{{route('home.post', $post->slug )}}" class="{{$disabled_link ?? ''}}"> 
	                        	{{ $post->title }}
	                        </a>
	                        <span class="badge badge-success badge-pill float-right">
	                        	Created {{ $post->created_at->diffForHumans() }}
	                        </span>
	                        <span class="badge badge-warning badge-pill float-right ">
	                        	{{ $post->is_active }}
	                        </span>
	                        <span class="badge badge-success badge-pill float-right {{$hide_edit_link ?? ''}}">
	                        	<a href="{{route('home.post.edit',$post->id)}}" style="color:white">
	                        	Edit
	                        	</a>
	                        </span>
	                      </li>

	                  @endforeach
	                @else
	                    <h4 class='text-success'>No POST Available</h4>
	                @endif
                </ul>
		            
	      	</div>




	      </div>  <!-- end of row-->

			<div class="row ">  
				<div class="my-5 mx-auto ">
					{{ $posts->links('home.pagination') }}
				</div>
			</div>
	      

        </div>  <!-- end of container -->





@endsection



</x-home.master-home>