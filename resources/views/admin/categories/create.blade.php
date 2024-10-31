@extends('admin.layout.app')

@section('title', 'Category | Create')

@section('content')
<main>
    <div class="content-wrapper m-4">
        <h1 class="mt-4">Create Category</h1>
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="row">
                <!-- Category Name -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="category">Category Name</label>
                        <input type="text" class="form-control" id="category" name="category" placeholder="Category Name" required>
                        @error('category')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Icon -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="icon">Icon</label>
                        <input type="text" class="form-control" id="icon" name="icon" placeholder="Icon Name" required>
                        @error('icon')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Description -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" class="form-control" id="description" name="description" placeholder="Description" required>
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-footer pt-5 border-top">
                <button type="submit" class="btn btn-primary btn-pill">Create</button>
                <a href="{{ route('categories') }}" class="btn btn-secondary btn-pill">Cancel</a>
            </div>
        </form>
    </div>
</main>
@endsection
