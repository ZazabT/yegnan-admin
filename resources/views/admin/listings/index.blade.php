@extends('admin.layout.app')

@section('title', 'Listing')
@section('content')
<main>
    @if ($listings->isEmpty())
        <div class="card-body">
            <h1 class="mt-4">Listing Table</h1>
            <p class="ml-2">No Listing found.</p>
        </div>
    @else
    <div class="card-body">
        <h1 class="mt-4">Listing Table</h1>

        <!-- Search Input -->
        <input type="search" class="form-control" placeholder="Search..." aria-controls="productsTable">

        <!-- Listing Table -->
        <table id="productsTable" class="table table-hover table-product" style="width:100%">
            <thead>
                <tr>
                  <th>ID</th>
                  <th>Host</th>
                  <th>Price Per Night</th>
                  <th>Max Guests</th>
                  <th>Starting Date</th>
                  <th>Ending Date</th>
                  <th>Status</th>
                  <th>Is Confirmed</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
            <tbody>
                @foreach ($listings as $listing)
                <tr>
                    <td>{{ $listing->id }}</td>
                    <td>{{ $listing->host->username }}</td>
                    <td>{{ $listing->price_per_night }} br</td>
                    <td>{{ $listing->max_guest }}</td>
                    <td>{{ $listing->start_date }}</td>
                    <td>{{ $listing->end_date }}</td>
                    <td>{{ $listing->status }}</td>
                    <td>{{ $listing->confirmed ? 'Yes' : 'No' }}</td>
                    <td>
                    <button type="button" class="btn p-0" data-toggle="modal" data-target="#viewModal{{ $listing->id }}" title="View image">
                      <i class="mdi mdi-eye mdi-24px eye_button"></i>
                    </button>
                    
                    
                   </td>
                    <td>
                      <div class="dropdown">
                        <a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdownMenuLink"
                          data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                            <!-- Confirm / Unconfirm Button -->
                            <form action="{{ route('listings.confirm', $listing->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" 
                                        class="dropdown-item {{ $listing->confirmed ? 'text-danger' : 'text-success' }} font-weight-bold">
                                    {{ $listing->confirmed ? 'Unconfirm' : 'Confirm' }}
                                </button>
                            </form>
                            <!-- Edit Button -->
                            <a class="dropdown-item font-weight-bold" href="#">
                                Edit
                            </a>
                            <!-- Delete Button -->
                            <form action="{{ route('listings.destroy', $listing->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="dropdown-item text-white font-weight-bold bg-danger" 
                                        style="border: none;">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </td>

                </tr>

                <!-- Modal Structure for Listing Details -->
                <div class="modal fade" id="viewModal{{ $listing->id }}" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document"> <!-- Use modal-lg for a wider modal -->
                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title" id="viewModalLabel">{{ $listing->title }}</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                          <div class="modal-body">
                              @if ($listing->item_images->isEmpty())
                                  <p>No images available for this listing.</p>
                              @else
                                  <div class="row">
                                      @foreach ($listing->item_images as $image)
                                          <div class="col-12 mb-3"> <!-- Change col size for larger images -->
                                              <img src="{{ asset($image->image_url) }}" alt="Listing Image" class="img-fluid modalImage" > 
                                          </div>
                                      @endforeach
                                  </div>
                              @endif
                          </div>
                      </div>
                  </div>
              </div>
              
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <nav aria-label="Page navigation example" class="mt-4">
            <ul class="pagination justify-content-end pagination-seperated pagination-seperated-rounded">
                @if ($listings->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link">Prev</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $listings->previousPageUrl() }}" aria-label="Previous">
                            <span aria-hidden="true" class="mdi mdi-chevron-left mr-1"></span> Prev
                        </a>
                    </li>
                @endif

                @for ($i = 1; $i <= $listings->lastPage(); $i++)
                    <li class="page-item {{ ($listings->currentPage() == $i) ? 'active' : '' }}">
                        <a class="page-link" href="{{ $listings->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor

                @if ($listings->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $listings->nextPageUrl() }}" aria-label="Next">
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
    @endif
</main>
<style>
 .eye_button:hover{
   color: white;
 }


 .modalImage {
    max-height: 400px;
    width: 100%; 
    object-fit: cover; 
    border-radius: 10px;
    transition: border-radius 0.3s ease; 
}

.modalImage:hover {
    border-radius: 0%; 
    transform: scale(1.06);
}

.modal-title{
  font-size: 20px;
  font-weight: 900;
  color:violet;
  letter-spacing: 2;
}


.close{
  font-size: 30px;
  font-weight: 900;
  color: red;
}

</style>

@section('scripts')
<script src='https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js'></script>
<script src='https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap5.min.js'></script>
<script src="{{ asset('js/custom.js') }}"></script>
@endsection
@endsection
