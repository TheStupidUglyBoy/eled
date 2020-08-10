



@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif




@if (Session::has('created_category') )
	<div class="alert alert-success">
        {{ session('created_category') }}
    </div>
@endif

@if (Session::has('updated_category') )
    <div class="alert alert-success">
        {{ session('updated_category') }}
    </div>
@endif

@if (Session::has('nothing_to_update') )
    <div class="alert alert-danger">
        {{ session('nothing_to_update') }}
    </div>
@endif

@if (Session::has('destroy_category') )
    <div class="alert alert-danger">
        {{ session('destroy_category') }}
    </div>
@endif






@if (Session::has('created_news') )
    <div class="alert alert-success">
        {{ session('created_news') }}
    </div>
@endif

@if (Session::has('destroy_news') )
    <div class="alert alert-danger">

        {!! session()->get('destroy_news')!!}        
    </div>
@endif



@if (Session::has('updated_news') )
    <div class="alert alert-success">
        {{ session('updated_news') }}
    </div>
@endif




@if (session()->has('success'))
        <div class="alert alert-success">
            {!! session()->get('success')!!}        
        </div>
@endif



@if (Session::has('updated_user') )
    <div class="alert alert-success">
        {{ session('updated_user') }}
    </div>
@endif





@if (Session::has('user_register') )
    <div class="alert alert-success">
        {{ session('user_register') }}
    </div>
@endif


@if (Session::has('user_not_verified') )
    <div class="alert alert-alert">
        {{ session('user_not_verified') }}
    </div>
@endif

@if (Session::has('login_fail') )
    <div class="alert alert-danger">
        {{ session('login_fail') }}
    </div>
@endif



@if (Session::has('verification_is_completed') )
    <div class="alert alert-success">
        {{ session('verification_is_completed') }}
    </div>
@endif


@if (Session::has('destroy_tips') )
    <div class="alert alert-danger">

        {!! session()->get('destroy_tips')!!}        
    </div>
@endif

@if (Session::has('updated_tips') )
    <div class="alert alert-success">
        {{ session('updated_tips') }}
    </div>
@endif


@if (Session::has('updated_post') )
    <div class="alert alert-success">
        {{ session('updated_post') }}
    </div>
@endif


@if (Session::has('softed_delete_post') )
    <div class="alert alert-success">
        {{ session('softed_delete_post') }}
    </div>
@endif


@if (Session::has('approval_or_draft') )
    <div class="alert alert-success">
        {{ session('approval_or_draft') }}
    </div>
@endif



@if (Session::has('force_delete_post') )
    <div class="alert alert-success">
        {{ session('force_delete_post') }}
    </div>
@endif

@if (Session::has('restore_delete_post') )
    <div class="alert alert-success">
        {{ session('restore_delete_post') }}
    </div>
@endif


@if (Session::has('updated_user_profile') )
    <div class="alert alert-success">
        {{ session('updated_user_profile') }}
    </div>
@endif

@if (Session::has('updated_user_password') )
    <div class="alert alert-success">
        {{ session('updated_user_password') }}
    </div>
@endif


@if (session()->has('comment_created_msg'))
        <div class="alert alert-success">
            {!! session()->get('comment_created_msg')!!}        
        </div>
@endif

@if (Session::has('comment_delete_msg') )
    <div class="alert alert-danger">
        {{ session('comment_delete_msg') }}
    </div>
@endif

@if (session()->has('updated_comment'))
        <div class="alert alert-success">
            {!! session()->get('updated_comment')!!}        
        </div>
@endif


@if (session()->has('update_company'))
        <div class="alert alert-success">
            {!! session()->get('update_company')!!}        
        </div>
@endif


@if (Session::has('no_email_found') )
    <div class="alert alert-danger">
        {{ session('no_email_found') }}
    </div>
@endif


@if (session()->has('reset_password_link'))
        <div class="alert alert-success">
            {!! session()->get('reset_password_link')!!}        
        </div>
@endif


@if (Session::has('destroy_image') )
    <div class="alert alert-danger">
        {{ session('destroy_image') }}
    </div>
@endif

@if (Session::has('destroy_video') )
    <div class="alert alert-danger">
        {{ session('destroy_video') }}
    </div>
@endif

@if (Session::has('destroy_company') )
    <div class="alert alert-danger">
        {{ session('destroy_company') }}
    </div>
@endif

@if (session()->has('markAllAsRead'))
        <div class="alert alert-success">
            {!! session()->get('markAllAsRead')!!}        
        </div>
@endif

@if (session()->has('markAsRead'))
        <div class="alert alert-success">
            {!! session()->get('markAsRead')!!}        
        </div>
@endif

@if (session()->has('home_create_post_success'))
        <div class="alert alert-success">
            {!! session()->get('home_create_post_success')!!}        
        </div>
@endif


@if (session()->has('home_create_post_update'))
        <div class="alert alert-success">
            {!! session()->get('home_create_post_update')!!}        
        </div>
@endif

@if (session()->has('reset_verification'))
        <div class="alert alert-success">
            {!! session()->get('reset_verification')!!}        
        </div>
@endif