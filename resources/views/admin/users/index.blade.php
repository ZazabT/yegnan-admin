@extends('admin.layout.app')

@section('content')
<style>
    /* Remove vertical lines and make the table look minimal */
    .table-borderless th, .table-borderless td {
        border: none;
    }

    /* Make header font bigger and bold */
    table thead th, table tfoot th {
        font-size: 1.2rem;
        font-weight: bold;
        color: #333; /* Use a darker gray */
    }

    /* Table data cell styling */
    table tbody td {
        font-size: 1rem;
        padding: 15px;
        color: #555;
    }

    /* Adjusting search input */
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

    /* Remove the background from the card header */
    .card-header {
        background-color: transparent;
        font-size: 1.4rem;
        color: #333; /* Dark color for text */
    }

    /* Ensure pagination looks consistent with the design */
    .pagination {
        justify-content: center;
    }
</style>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Users Table</h1>

        <div class="mb-3">
            <input type="text" id="searchInput" class="form-control" placeholder="Search Users...">
        </div>

        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatablesSimple" class="table table-borderless">
                        <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Is Host</th>
                                <th>Age</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Is Host</th>
                                <th>Age</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->firstName }}</td>
                                    <td>{{ $user->lastName }}</td>
                                    <td>{{ $user->isHomeOwner ? 'Yes' : 'No' }}</td>
                                    <td>{{ $user->age }}</td>
                                    <td>{{ $user->created_at->format('Y-m-d H:i:s') }}</td>
                                    <td>
                                        <a href="#" class="text-primary" data-toggle="tooltip" title="Edit User"><i class="fas fa-edit"></i></a>

                                        <a href="#" 
                                           class="text-danger" 
                                           data-toggle="tooltip" 
                                           title="Delete User"
                                           onclick="event.preventDefault(); document.getElementById('delete-form-{{ $user->id }}').submit();"><i class='fas fa-trash'></i></a>

                                        <form id='delete-form-{{ $user->id }}' action="{{ route('users.destroy', $user->id) }}" method='POST' style='display:none;'>
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination Controls -->
                    {{ $users->onEachSide(1)->links() }}
                </div>

            </div>
        </div>

    </div>
</main>

@section('scripts')
<script src='https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js'></script>
<script src='https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap5.min.js'></script>

<script>
// Search functionality for users
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
