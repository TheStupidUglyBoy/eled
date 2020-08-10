<x-home.master-home>
@section('page.title',$page_title)


@section('page.content')
<div class="container">

      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{route('user_profile')}}">User</a></li>
          <li class="breadcrumb-item active" aria-current="page">Profile Settings</li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->
      <div class="row">
        <div class="col-12">
          @include('includes.notification_msg')
        </div>
      </div>
      <div class="row gutters-sm mb-3 ">
        <div class="col-md-4 d-none d-md-block">
          <div class="card">
            <div class="card-body">
              <nav class="nav flex-column nav-pills nav-gap-y-1">
                <a href="#profile" data-toggle="tab" class="nav-item nav-link has-icon nav-link-faded active">
                  <i class="fas fa-user"></i> Profile Information
                </a>
                <a href="#notification" data-toggle="tab" class="nav-item nav-link has-icon nav-link-faded">
                  <i class="far fa-bell"></i> Notifications
                </a>

                <a href="#company" data-toggle="tab" class="nav-item nav-link has-icon nav-link-faded">
                  <i class="far fa-building"></i> Company Profile
                </a>
                <a href="#security" data-toggle="tab" class="nav-item nav-link has-icon nav-link-faded">
                  <i class="fas fa-lock"></i> Security
                </a>
                <a href="#comment" data-toggle="tab" class="nav-item nav-link has-icon nav-link-faded">
                  <i class="far fa-comment"></i> Comments
                </a>
                <a href="{{route('logout')}}"  class="nav-item nav-link has-icon nav-link-faded">
                  <i class="fas fa-sign-out-alt"></i> Log Out
                </a>

              </nav>
            </div>
          </div>
        </div>
        <div class="col-md-8">
          <div class="card">

            <div class="card-body tab-content">
              <div class="tab-pane active" id="profile">
                <h6>YOUR PROFILE INFORMATION</h6>
                <hr>
                  <form method="POST" action="{{route('update_user_profile',$user)}}" enctype="multipart/form-data" id="profile-form">
                      @csrf
      		            @method('PATCH')
                      <div class="form-group">
                          <img class="img-profile rounded-circle" width='50' height="50" src="{{$user->get_user_avatar($user) }}" alt="..." class="img-fluid">
      		            </div>
                  		<div class="form-group">
                        <input type="text" class="form-control" name="email" value="{{$user->email}}" disabled >
                      </div>

                      <div class="form-group">
                        <label for="username">UserName:</label>		
                        <input type="text" class="form-control" name="username" value="{{$user->username}}" required>
                      </div>
                      <div class="form-group">
                        <label for="last_name">Last Name:</label>		
                        <input type="text" class="form-control" name="last_name" value="{{$user->last_name}}" >
                      </div>
                      <div class="form-group">
                        <label for="first_name">First Name:</label>		
                        <input type="text" class="form-control" name="first_name" value="{{$user->first_name}}">
                      </div>

                      <div class="form-group">
                        <label for="bio">About Me:</label>
                        <textarea class="form-control" placeholder="{{$user->bio}}" name="bio" id="bio" rows="3">{{$user->getAttributes()['bio']}}</textarea>
                      </div>

                      <div class="form-group">
            					    <label for="image">Upload Avatar</label>
            					    <input type="file" class="form-control-file" id="image" name="image">
            					</div>

                      <button type="submit" class="btn btn-success btn-block">Create Now</button>
                  </form>
                

              </div>

              <div class="tab-pane" id="notification">
                <h6>Notifications  <span> are kept only for 7days</span> </h6>
                <hr>
                @if( $notifications->count() >= 1     )
                  <a href="{{route('user.notification.markAllAsRead')}}" class="text-success "> Mark All as read </a>
                  <ul class="list-group" >
                    @foreach ($notifications as $notification)
@php
    if( $notification->read_at == null ){
        $read_status = 'unread list-group-item-warning';
        $disabled_link = '';
    }else{
        $read_status = 'read';
        $disabled_link = 'disabled-link';
    }
@endphp
                            <li class="list-group-item {{$read_status}} " id="{{$notification->id}}" > 
                                <a class="{{$disabled_link}}"
                                href="{{route('user.notification.markAsRead',  ['id' => $notification->id , 'url' => $notification->data['url']  ]  )}}"
                                > {!! $notification->data['msg'] !!}{{ $notification->created_at->diffForHumans()  }}
                                </a>
                            </li>
                    @endforeach
                  </ul>

                  <div class="my-3  ">
                      {{ $notifications->fragment('notification')->links('home.pagination') }}
                  </div>
                @else
                <h3>No Notifications</h3>
                @endif

              </div>


              <div class="tab-pane" id="company">
                  <h6>YOUR COMPANY INFORMATION</h6>
                  <hr>
                @if( is_null(Auth::user()->company) )

                
                  <form method="POST" action="{{route('user.company.store')}}" enctype="multipart/form-data" id="company-form">
                    @csrf


                    <div class="form-group">
                      <label for="name">Company Name:</label>
                      <input type="text" class="form-control" name="name"
                       value="" required placeholder="Input Your Company Name">
                    </div>

                    <div class="form-group">
                      <label for="name">Company Website:</label>
                      <input type="text" class="form-control" name="website" placeholder="Etc : https://google.com" >
                    </div>

                    <div class="form-group">
                      <label for="name">Contact Number:</label>
                      <input type="text" class="form-control" name="contact_number" id="contact_number"
                       value="" placeholder="Etc : 13790450900" >
                    </div>

                    <div class="form-group">
                      <label for="location">Location</label>   
                      <input type="text" class="form-control" name="location" placeholder="Input your company location" required>
                    </div>

                    <div class="form-group">
                      <label for="about">About Comapany:</label>
                      <textarea class="form-control" placeholder="tell us your company about" name="about" id="about" rows="3"></textarea>

                    </div>

                    <div class="form-group">
                        <label for="business_license">Upload business License</label>
                        <input type="file" class="form-control-file" id="business_license" name="business_license">
                    </div>
                    <small class="form-text text-danger">Please kindly Upload Your Company Business License</small>

                    <button type="submit" class="btn btn-success btn-block">Create Now</button>
                  </form>

                  @else
                    <h4>Your Company Profile Is Being Reviewed By Adminstrator.</h4>
                  @endif
              </div>

               
              <div class="tab-pane" id="security">
 
                <h6>SECURITY SETTINGS</h6>
                <hr>

                <form method="POST" action="{{route('update_user_password',$user)}}" id="change-password-form">
          					@csrf
          					@method('PATCH')
          					<div class="form-group">
          						<input type="text" class="form-control" name="email" value="{{$user->email}}" disabled >
          					</div>
          					<div class="form-group">
          						<label class="d-block">Change Password</label>
          						<input type="password" name="current_password" class="form-control" placeholder="Enter your old password" required>
          						<input type="password" name="new_password" id="new_password" class="form-control mt-1" placeholder="New password" required>
          						<input type="password" name="new_confirm_password" class="form-control mt-1" placeholder="Confirm new password" required>
          					</div>
          					<hr>
          					<button type="submit" class="btn btn-success btn-block">Update Now</button>
                </form>
                <hr>
              </div>

              <div class="tab-pane" id="comment">
                <h6> ALL COMMENTS</h6>
                <hr>
                @if( $comments->count() >= 1     )
                  <ul class="list-group" >
                    @foreach ($comments as $comment)
                    <li class="list-group-item" > 
                      <a href="{{route('home.post',$comment->post->slug)}}"> {{ $comment->body }} 
                         <span class="badge"> {{ $comment->is_active }} </span>
                      </a>
                    </li>
                    @endforeach
                  </ul>
                @else
                <h3>Make you ever first comment on post</h3>
                @endif
                <hr>
              </div>

            </div>
          </div>
        </div>
      </div>

</div>  <!--container -->




@endsection



@section('script')
<script src="{{asset('app/js/jquery.validate.js')}}" ></script>
<script src="{{asset('js/validation.js')}}" ></script>
<script type="text/javascript">
  $(document).ready(function() {
    //display pill as url query string
    var url = document.location.toString();
    if (url.match('#')) {
        $('.nav-pills a[href="#' + url.split('#')[1] + '"]').tab('show');
    } 
    $('.nav-pills a').on('shown.bs.tab', function (e) {
        window.location.hash = e.target.hash;
    })
  });
</script>

@endsection



</x-home.master-home>