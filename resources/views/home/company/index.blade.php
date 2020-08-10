<x-home.master-home>
@section('page.title',$page_title)


@section('page.content')

<div class="container">
      <div class="row">
        <!-- Latest companies -->
        <main class="post-listing col-lg-12"> 
          <div class="container">
            <div class="row my-3">
              <h5>all company  </h5>
            </div> 
            <div class="row">
              @if (  $companies->isNotEmpty()   )
                @foreach ($companies as $company)
                <div class="post col-xl-4">

                  <div class="post-details">
                    <div class="post-meta d-flex justify-content-between">
                      <div class="date meta-last">  {{ $company->created_at }}  </div>
                    </div>

                    <a href="{{route('home.companies.show',$company->id)}}">
                      <h3 class="h4 text-break"> {{   $company->name }} </h3>
                    </a>
                    
                    <p class="text-break text-muted">{{ $company->about  }}</p>

                  </div>
                </div>
                @endforeach
              @else
                  <h4 class='text-success mb-5'>No Companies Available</h4>
              @endif
 
            </div>




          </div>
        </main>
        

     
      </div>
    </div>



@endsection
</x-home.master-home>