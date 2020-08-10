<x-home.master-home>
@section('page.title',$page_title)


@section('page.content')

<div class="container">
      <div class="row">
        <!-- Latest Posts -->
        <main class=" col-lg-8"> 
          <div class="container">
            <div class="row">
              <div class=" col-md-12"> 
                <div id="accordion">
              @if (  $tips->isNotEmpty()   )
                @foreach ($tips as $tip)
                          <div class="card">
                            <div class="card-header">
                              <a class="card-link" data-toggle="collapse" href="#tip{{$tip->id}}" >
                                {{ $tip->question}}
                              </a>
                            </div>
                            <div id="tip{{$tip->id}}" class="collapse " data-parent="#accordion">
                              <div class="card-body">
                                 {!! clean($tip->answer)  !!} 
                              </div>
                            </div>
                          </div>
                        
                      
                @endforeach
              @else
                  <h4 class='text-success'>No Tip Tutorials Available</h4>
              @endif
                </div>

                <div class="my-5">
                    {{ $tips->links('home.pagination') }}
                </div>
              </div>   <!-- column !-->
            </div> <!-- row !-->
          </div>  <!-- container !-->
        </main>
        

 <x-home.sidebar-home/>       
      </div>
    </div>



@endsection

@section('script')
<script type="text/javascript">

  @if (  $tips->isNotEmpty()   )
  @foreach ($tips as $tip)
      if (window.location.search == '?tip{{$tip->id}}') {
        $('#tip{{$tip->id}}').addClass('show');
      }
  @endforeach
  @endif
</script>
@endsection
</x-home.master-home>