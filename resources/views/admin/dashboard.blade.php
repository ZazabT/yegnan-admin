@extends('admin.layout.app')

@section('title', 'Admin Dashboard')
@section('content')
<div id="layoutSidenav_content">
    <main>

         

        <script>
            NProgress.configure({ showSpinner: false });
            NProgress.start();
          </script>
      <div id="toaster"></div>


        <div class="container-fluid px-4 py-4">
            <div class="row">
                <!-- Card 1: Total Users -->
                <div class="col-md-3">
                    <div class="card text-white bg-secondary mb-3 card-hover">
                        <h5 class="card-header text-white">Total Users</h5>
                        @php
                            use App\Models\User;
                            $users = User::count();
                        @endphp
                        <div class="card-body">
                            <p class="card-text">{{ $users }}</p>
                            <a href="#" class="btn btn-link text-white px-0">View Details</a>
                        </div>
                    </div>
                </div>
                
                <!-- Card 2: Total Hosts -->
                <div class="col-md-3">
                    <div class="card text-white bg-primary mb-3 card-hover">
                        <h5 class="card-header text-white">Total Hosts</h5>
                        @php
                            use App\Models\Host;
                            $hosts = Host::count();
                        @endphp
                        <div class="card-body">
                            <p class="card-text">{{ $hosts }}</p>
                            <a href="#" class="btn btn-link text-white px-0">View Details</a>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Total Bookings -->
                <div class="col-md-3">
                    <div class="card text-white bg-success mb-3 card-hover">
                        <h5 class="card-header text-white">Total Bookings</h5>
                        @php
                            use App\Models\Booking;
                            $bookings = Booking::count();
                        @endphp
                        <div class="card-body">
                            <p class="card-text">{{ $bookings }}</p>
                            <a href="#" class="btn btn-link text-white px-0">View Details</a>
                        </div>
                    </div>
                </div>

                <!-- Card 4: Total Listings -->
                <div class="col-md-3">
                    <div class="card text-white bg-danger mb-3 card-hover">
                        <h5 class="card-header text-white">Total Listings</h5>
                        @php
                            use App\Models\Listing;
                            $listings = Listing::count();
                        @endphp
                        <div class="card-body">
                            <p class="card-text">{{ $listings }}</p>
                            <a href="#" class="btn btn-link text-white px-0">View Details</a>
                        </div>
                    </div>
                </div>

                <!-- Card 5: Total Categories -->
                <div class="col-md-3">
                    <div class="card text-white bg-warning mb-3 card-hover">
                        <h5 class="card-header text-white">Total Categories</h5>
                        @php
                            use App\Models\Category;
                            $categories = Category::count();
                        @endphp
                        <div class="card-body">
                            <p class="card-text">{{ $categories }}</p>
                            <a href="#" class="btn btn-link text-white px-0">View Details</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

@endsection

@section('scripts')
<script src='https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js'></script>
<script src='https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap5.min.js'></script>
<script src="{{ asset('js/custom.js') }}"></script>
<script src="{{asset('plugins/toaster/toastr.min.js')}}"></script>
@endsection


<!-- Add the following CSS inside your blade or a linked stylesheet -->
<style>
    /* Gradient background for cards */
    
    /* Hover effect for cards */
    .card-hover {
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        border-radius: 10px; 
    }

    .card-hover:hover {
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
        transform: translateY(-10px) scale(1.05); 
    }
    /* Adjust text padding */
    .card-body p {
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 0.5rem;
        transition: color 0.3s ease;
    }
  

    /* Additional padding for the card header */
    .card-header {
        padding: 1.25rem;
        font-size: 1.2rem; 
        font-weight: bold;
        border-bottom: none; 
    }
</style>
