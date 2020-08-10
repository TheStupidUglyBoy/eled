<x-home.master-home>
@section('page.title',$page_title)


@section('style')
  <link rel="stylesheet" href="{{asset('app/css/jquery.fancybox.min.css')}}" />
@endsection


@section('page.content')
    <div class="container">
      <h1 class="font-weight-light text-center text-lg-left mt-4 mb-0 theme-color">Thumbnail Gallery</h1>
      <hr class="mt-2 mb-5">

    @if( $galleries->count() >= 1 )
      <div class="row text-center text-lg-left">

          @foreach( $galleries as $gallery)
            <div class="col-lg-3 col-md-4 col-6">
              <a href="{{ $gallery->image()->latest()->first()->name }}" 
                class="d-block mb-4 h-100" 
                data-caption="{{ $gallery->description }}"
                data-fancybox="gallery">
                  <img class="img-fluid img-thumbnail" src="{{ $gallery->get_image($gallery) }}" alt="">
              </a>
            </div>
          @endforeach

          
      </div>

      <div class="row ">  
          <div class="my-5 mx-auto ">
            {{ $galleries->links('home.pagination') }}
          </div>
      </div>    
    @else
      <h3 class="text-success mb-5 pb-5">No Imges Available at the moment</h3>

    @endif


    </div>
<!-- /.container -->



@endsection

@section('script')
  <script src="{{asset('app/js/jquery.fancybox.min.js')}}"></script>
@endsection


</x-home.master-home>