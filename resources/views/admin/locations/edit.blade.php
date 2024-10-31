@extends('admin.layout.app')

@section('title', 'Location | Edit')

@section('content')
<main>
    <div class="content-wrapper m-4">
        <h1 class="mt-4">Edit Location</h1>
        <form action="{{ route('locations.update', $location->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="country">Country</label>
                        <input type="text" class="form-control" id="country" name="country" value="{{ old('country', $location->country) }}" placeholder="Country" required>
                        @error('country')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="region">Region</label>
                        <input type="text" class="form-control" id="region" name="region" value="{{ old('region', $location->region) }}" placeholder="Region" required>
                        @error('region')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" class="form-control" id="city" name="city" value="{{ old('city', $location->city) }}" placeholder="City Name" required>
                        @error('city')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                
            </div>

            <div class="row">
              

            </div>

            <div class="form-footer pt-5 border-top">
                <button type="submit" class="btn btn-primary btn-pill">Update</button>
                <a href="{{ route('locations') }}" class="btn btn-secondary btn-pill">Cancel</a>
            </div>
        </form>
    </div>
</main>
@endsection
