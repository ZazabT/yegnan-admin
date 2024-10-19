@extends('admin.layout.app')

@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Edit Listing</h1>

        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('listings.update', $listing->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" id="title" name="title" class="form-control" value="{{ $listing->title }}" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" class="form-control" rows="4" required>{{ $listing->description }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="price_per_night">Price per Night ($)</label>
                        <input type="number" id="price_per_night" name="price_per_night" class="form-control" value="{{ $listing->price_per_night }}" step="0.01" required>
                    </div>

                    <div class="form-group">
                        <label for="max_guest">Max Guests</label>
                        <input type="number" id="max_guest" name="max_guest" class="form-control" value="{{ $listing->max_guest }}" required>
                    </div>

                    <div class="form-group">
                        <label for="bedrooms">Bedrooms</label>
                        <input type="number" id="bedrooms" name="bedrooms" class="form-control" value="{{ $listing->bedrooms }}" required>
                    </div>

                    <div class="form-group">
                        <label for="bathrooms">Bathrooms</label>
                        <input type="number" id="bathrooms" name="bathrooms" class="form-control" value="{{ $listing->bathrooms }}" required>
                    </div>

                    <div class="form-group">
                        <label for="beds">Beds</label>
                        <input type="text" id="beds" name="beds" class="form-control" value="{{ $listing->beds }}" required>
                    </div>

                    <div class="form-group">
                        <label for="confirmed">Confirmed</label>
                        <select id="confirmed" name="confirmed" class="form-control" required>
                            <option value="1" {{ $listing->confirmed ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ !$listing->confirmed ? 'selected' : '' }}>No</option>
                        </select>
                    </div>
                    

                    <div class="form-group">
                        <label for="rules">Rules</label>
                        <textarea id="rules" name="rules" class="form-control" rows="4">{{ $listing->rules }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="start_date">Start Date</label>
                        <input type="date" id="start_date" name="start_date" class="form-control" value="{{ $listing->start_date->format('Y-m-d') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="end_date">End Date</label>
                        <input type="date" id="end_date" name="end_date" class="form-control" value="{{ $listing->end_date->format('Y-m-d') }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Update Listing</button>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
