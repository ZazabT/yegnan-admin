@extends('admin.layout.app')

@section('title', 'Booking')

@section('content')
<main>
    @if($bookings->isEmpty())
        <div class="card-body m-5">
            <h1 class="mt-4">Booking Table</h1>
            <p class="ml-2">No Booking found.</p>
        </div>
     @else
     <div class="card-body">
    <h1 class="mt-4">Booking Table</h1>

    <!-- Search Input -->
    <input type="search" class="form-control" placeholder="Search..." aria-controls="productsTable">
     <table class="table table-striped">
        <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Hoster</th>
              <th scope="col">Guest</th>
              <th scope="col">Cheack_In</th>
              <th scope="col">Cheack_Out</th>
              <th scope="col">Total_Price</th>
              <th scope="col">Status</th>
              <th scope="col">Accept</th>
            </tr>
          </thead>


        <tbody>
            @foreach ($bookings as $booking )
            <tr>
                <td scope="row">{{$booking->id}}</td>
                <td>{{$booking->listing->host->username }}</td>
                <td>{{$booking->guest->firstName}}</td>
                <td>{{$booking->checkin_date}}</td>
                <td>{{$booking->checkout_date}}</td>
                <td>{{$booking->total_price}}</td>
                <td>{{$booking->status}}</td>
                <td>
                  <label class="switch switch-primary switch-pill form-control-label ">
                    <input type="checkbox" class="switch-input form-check-input" value="on">
                    <span class="switch-label"></span>
                    <span class="switch-handle"></span>
                  </label>
                </td>
              </tr>
                
            @endforeach
            
        </tbody>

    </table>

    <!-- Pagination -->
    <nav aria-label="Page navigation example" class="mt-7">
        <ul class="pagination justify-content-end pagination-seperated pagination-seperated-rounded">
            @if ($bookings->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">Prev</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $bookings->previousPageUrl() }}" aria-label="Previous">
                        <span aria-hidden="true" class="mdi mdi-chevron-left mr-1"></span> Prev
                    </a>
                </li>
            @endif

            @for ($i = 1; $i <= $bookings->lastPage(); $i++)
                <li class="page-item {{ ($bookings->currentPage() == $i) ? 'active' : '' }}">
                    <a class="page-link" href="{{ $bookings->url($i) }}">{{ $i }}</a>
                </li>
            @endfor

            @if ($bookings->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $bookings->nextPageUrl() }}" aria-label="Next">
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


@section('scripts')
<script src='https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js'></script>
<script src='https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap5.min.js'></script>
<script src="{{ asset('js/custom.js') }}"></script>
@endsection
@endsection




    
  
      
    