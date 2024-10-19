@extends('admin.layout.app')

@section('content')
<style>
    /* Table Styling */
    .table-borderless th, .table-borderless td {
        border: none;
    }

    /* Table header styling */
    table thead th, table tfoot th {
        font-size: 1.2rem;
        font-weight: bold;
        color: #333;
    }

    /* Table data cell styling */
    table tbody td {
        font-size: 1rem;
        padding: 15px;
        color: #555;
    }

    /* Search input styling */
    #searchInput {
        margin-bottom: 20px;
        padding: 10px;
        border-radius: 8px;
    }

    /* Adding some space between rows */
    table tbody tr {
        border-bottom: 1px solid #eaeaea;
    }

    /* Hover effect on table rows */
    table tbody tr:hover {
        background-color: #f9f9f9;
    }

    /* Pagination styling */
    .pagination {
        justify-content: center;
    }
</style>

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Listings Table</h1>

        <!-- Search Input -->
        <div class="mb-3">
            <input type="text" id="searchInput" class="form-control" placeholder="Search Listings...">
        </div>

        <!-- Listings Table -->
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatablesSimple" class="table table-borderless">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Price per Night</th>
                                <th>Max Guests</th>
                                <th>Status</th>
                                <th>Host</th>
                                <th>Location</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Confirmed</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Title</th>
                                <th>Price per Night</th>
                                <th>Max Guests</th>
                                <th>Status</th>
                                <th>Host</th>
                                <th>Location</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Confirmed</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($listings as $listing)
                                <tr>
                                    <td>{{ $listing->title }}</td>
                                    <td>${{ number_format($listing->price_per_night, 2) }}</td>
                                    <td>{{ $listing->max_guest }}</td>
                                    <td>{{ ucfirst($listing->status) }}</td>
                                    <td>{{ $listing->host->user->firstName }}</td>
                                    <td>{{ $listing->location->city }}</td>
                                    <td>{{ $listing->start_date->format('Y-m-d') }}</td>
                                    <td>{{ $listing->end_date->format('Y-m-d') }}</td>
                                    <td>{{ $listing->confirmed ? 'Confirmed' : 'Pending'}}</td>
                                    <td>
                                        <a href="{{ route('listings.edit', $listing->id) }}" class="text-primary" data-toggle="tooltip" title="Edit Listing"><i class="fas fa-edit"></i></a>

                                        <a href="{{ route('listings.edit', $listing->id) }}" 
                                           class="text-danger" 
                                           data-toggle="tooltip" 
                                           title="Delete Listing"
                                           onclick="event.preventDefault(); document.getElementById('delete-form-{{ $listing->id }}').submit();"><i class='fas fa-trash'></i></a>

                                        <form id='delete-form-{{ $listing->id }}' action="#" method='POST' style='display:none;'>
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination Controls -->
                    {{ $listings->onEachSide(1)->links() }}
                </div>

            </div>
        </div>

    </div>
</main>

@section('scripts')
<script src='https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js'></script>
<script src='https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap5.min.js'></script>

<script>
// Search functionality for listings
$(document).ready(function() {
    $('#searchInput').on('keyup', function() {
        var value = $(this).val().toLowerCase();
        $('#datatablesSimple tbody tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });
});
</script>

@endsection
@endsection
