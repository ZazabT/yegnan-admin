@extends('admin.layout.app')

@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Admin Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Overview</li>
            </ol>
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">Total Users</div>
                        @php
                            use App\Models\User;
                            $users = User::count();
                        @endphp
                        <div class="total-count">{{ $users }}</div> <!-- Added class here -->
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="users.html">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body">Total Bookings</div>
                        @php
                            use App\Models\Booking;
                            $bookings = Booking::count();
                        @endphp
                        <div class="total-count">{{ $bookings }}</div> <!-- Added class here -->
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="bookings.html">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body">Total Listings</div>
                        @php
                            use App\Models\Listing;
                            $listings = Listing::count();
                        @endphp
                        <div class="total-count">{{ $listings }}</div> <!-- Added class here -->
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="listings.html">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-danger text-white mb-4">
                        <div class="card-body">Total Categories</div>
                        @php
                            use App\Models\Category;
                            $categories = Category::count();
                        @endphp
                        <div class="total-count">{{ $categories }}</div> <!-- Added class here -->
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="reviews.html">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="py-4 mt-auto bg-dark">
        <div class="container-fluid px-4">
            <div class="d-flex align-items-center justify-content-between small">
                <div class="text-muted">Copyright &copy; Yegnan 2024</div>
                <div>
                    <a href="#" class="text-muted">Privacy Policy</a>
                    &middot;
                    <a href="#" class="text-muted">Terms &amp; Conditions</a>
                </div>
            </div>
        </div>
    </footer>
</div>
@endsection
