<x-home.master-home>
@section('page.title',$page_title)


@section('page.content')

<div class="container">
      <div class="row">

        <div class=" col-lg-8"> 
          <div class="container">
            <div class="row my-4">
              <div class="col-lg-12">
                <h1>{{$company->name}}</h1>
                <hr>
                <h4>Location</h4>
                <address class="text-break">{{$company->location}}</address>
                <hr>
                <h5 class="text-break" >About <span class="text-success"> {{$company->name}} </span> </h5>
                <p class="text-break" > {{  $company->getAttributes()['about']  }}</p>

                <hr>
                @if (  !is_null($company->website)  )
                  <p>Visit 
                    <a target="_blank" class='text-success' href="{{$company->website}}">{{$company->name}}</a> Now
                  </p>
                @endif

              </div> <!-- end of column -->
              
            </div>  <!-- end of row -->
          </div>

          <hr>

          <div class="container">   
            <div class="row my-4">
              @if (  $company->user->isNotEmpty()   )
                @foreach ($company->user as $user)
                <div class=" col-lg-4 text-center">
                  <img src="{{$user->get_user_avatar($user) }}" width="60" height="60" alt="..." class="img-fluid">
                  <h5 class="text-break">
                    <a class="text-success text-break" href="{{route('home.user.post',$user)}}">{{$user->username}}</a>
                  </h5>
                  <strong>About Me</strong>
                  <p class="text-break" >{{ Str::limit($user->bio,50 )  }}</p>
                </div>  
                @endforeach
              @else
                <h4 class='text-success'>No Users Available</h4>
              @endif
              
 
            </div>
          </div>  


          
        </div>
        

 <x-home.sidebar-home/>       
      </div>
    </div>



@endsection
</x-home.master-home>