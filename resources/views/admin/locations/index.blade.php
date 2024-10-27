@extends('admin.layout.app')

@section('title' , 'Locaion')


@section('content')
<main>

    @if ($locations->isEmpty())
        
    <div class="card-body">
        <h1 class="mt-4">Locations Table</h1>
        <p class="ml-2">No Location found.</p>
    </div>
        
    @else
    
    <div class="content-wrapper m-4">
        <h1 class="mt-4">Location Table</h1>
    <!-- Search Input -->
    <input type="search" class="form-control" placeholder="Search..." aria-controls="productsTable">
        <table class="table table-striped">

                <thead>
                    <tr>
                      <th scope="col">ID</th>
                      <th scope="col">Country</th>
                      <th scope="col">Region</th>
                      <th scope="col">City</th>
                      <th></th>
                    </tr>
                  </thead>
                
                <tbody>
                    @foreach ($locations as $location)
                    <tr>
                        <td scope="row">{{$location->id}}</td>
                        <td>{{$location->country}}</td>
                        <td>{{$location->region}}</td>
                        <td>{{$location->city}}</td>
                        <td>
                            <div class="dropdown">
                              <a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                              </a>
                    
                              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="#">Edit</a>
                                <a class="dropdown-item bg-danger text-white" href="#">Delete</a>
                              </div>
                            </div>
                          </td>
                      </tr>
                      @endforeach
                </tbody>
               
            </table>
           


            <!-- Pagination -->
        <nav aria-label="Page navigation example" class="mt-4">
            <ul class="pagination justify-content-end pagination-seperated pagination-seperated-rounded">
                @if ($locations->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link">Prev</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $locations->previousPageUrl() }}" aria-label="Previous">
                            <span aria-hidden="true" class="mdi mdi-chevron-left mr-1"></span> Prev
                        </a>
                    </li>
                @endif

                @for ($i = 1; $i <= $locations->lastPage(); $i++)
                    <li class="page-item {{ ($locations->currentPage() == $i) ? 'active' : '' }}">
                        <a class="page-link" href="{{ $locations->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor
                @if ($locations->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $locations->nextPageUrl() }}" aria-label="Next">
                            Next
                            <span aria-hidden="true" class="mdi mdi-chevron-right ml-1"></span>
                        </a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <span class="page-link">Next</span>
                    </li>
                @endif
            </ul>
        </nav>
            
        </div>
    </div>
    @endif
</main>

@endsection