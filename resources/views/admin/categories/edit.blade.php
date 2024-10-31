@extends('admin.layout.app')

@section('title', 'Category | Edit')

@section('content')
<main>
    <div class="content-wrapper m-4">
        <h1 class="mt-4">Edit Category</h1>
        <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row">
                <!-- Category Name -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $category->name) }}" placeholder="Category Name" required>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Icon -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="icon">Icon</label>
                        <input type="text" class="form-control" id="icon" name="icon" value="{{ old('icon', $category->icon) }}" placeholder="Icon for the category" required>
                        @error('icon')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Description -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" rows="10" name="description" placeholder="Description" required>{{ old('description', $category->description) }}</textarea>
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-footer pt-5 border-top">
                <button type="submit" class="btn btn-primary btn-pill">Update</button>
                <a href="{{ route('categories') }}" class="btn btn-secondary btn-pill">Cancel</a>
            </div>
        </form>
    </div>
</main>
@endsection
