@extends('admin.layout.app')

@section('title', 'Users')
@section('content')
<main>

    @if ($users->isEmpty())
        <div class="card-body">
            <h1 class="mt-4">Users Table</h1>
            <p class="ml-2">No users found.</p>
        </div>
    @else

    <div class="card-body">
        <h1 class="mt-4">Users Table</h1>
        <table id="productsTable" class="table table-hover table-product" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Age</th>
                    <th>Is Host</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->firstName }}</td>
                    <td>{{ $user->lastName }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->age }}</td>
                    <td>{{ $user->isHomeOwner ? 'Yes' : 'No' }}</td>
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
                @if ($users->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link">Prev</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $users->previousPageUrl() }}" aria-label="Previous">
                            <span aria-hidden="true" class="mdi mdi-chevron-left mr-1"></span> Prev
                        </a>
                    </li>
                @endif

                @for ($i = 1; $i <= $users->lastPage(); $i++)
                    <li class="page-item {{ ($users->currentPage() == $i) ? 'active' : '' }}">
                        <a class="page-link" href="{{ $users->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor
 @if ($users->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $users->nextPageUrl() }}" aria-label="Next">
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
