<x-home.master-home>
@section('page.title',$page_title)


@section('style')
  <link rel="stylesheet" href="{{asset('app/css/jquery.fancybox.min.css')}}" />
@endsection


@section('page.content')
    <div class="container">
      <h1 class="font-weight-light text-center text-lg-left mt-4 mb-0">Videos</h1>
      <hr class="mt-2 mb-5">
      <div class="row text-center text-lg-left">
        <div class="col-sm-12 col-md-6 mb-5 h-100">
          <div class="embed-responsive embed-responsive-21by9 ">
            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/0FprI1Pv9fM" allowfullscreen></iframe>
          </div>
        </div>

        @if( $videos->count() >= 1 )

          @foreach( $videos as $video)
            <div class="col-sm-12 col-md-6 mb-5 h-100">
              <div class="embed-responsive embed-responsive-21by9 ">
                <iframe class="embed-responsive-item" src="{{$video->get_video($video)}}" allowfullscreen></iframe>
              </div>

            </div>
          @endforeach
        @else
          <h3 class="text-success mb-5 ">No Videos Available at the moment</h3>
        @endif
      </div>  

    </div>
<!-- /.container -->



@endsection

@section('script')
  <script src="{{asset('app/js/jquery.fancybox.min.js')}}"></script>
@endsection


</x-home.master-home>