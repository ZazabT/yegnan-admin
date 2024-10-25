@extends('admin.layout.app')

@section('title', 'Categories')

@section('content')

<main>
    @if ($categories->isEmpty())
        
    <div class="card-body">
        <h1 class="mt-4">Categories Table</h1>
        <p class="ml-2">No Category found.</p>
    </div>
        
    @else
    <h1 class="mt-4">Categories Table</h1>
    <!-- Search Input -->
    <input type="search" class="form-control" placeholder="Search..." aria-controls="productsTable">
    <div class="content-wrapper">
        <div class="row">
            @foreach ($categories as $category)
            <table class="table table-dark">
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
                    <tr>
                        <td scope="row">{{$category->id}}</td>
                        <td>{{$category->country}}</td>
                        <td>{{$category->region}}</td>
                        <td>@{{$category->city}}</td>
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
                </tbody>

            </table>



            <!-- Pagination -->
        <nav aria-label="Page navigation example" class="mt-4">
            <ul class="pagination justify-content-end pagination-seperated pagination-seperated-rounded">
                @if ($categories->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link">Prev</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $categories->previousPageUrl() }}" aria-label="Previous">
                            <span aria-hidden="true" class="mdi mdi-chevron-left mr-1"></span> Prev
                        </a>
                    </li>
                @endif

                @for ($i = 1; $i <= $categories->lastPage(); $i++)
                    <li class="page-item {{ ($categories->currentPage() == $i) ? 'active' : '' }}">
                        <a class="page-link" href="{{ $categories->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor
                @if ($categories->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $categories->nextPageUrl() }}" aria-label="Next">
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
            @endforeach
        </div>
    </div>
    @endif
</main>

@endsection







   
   
      
    