@extends('admin.layout.app')

@section('title', 'Hosts')

@section('content')

<main>
    @if ($hosts->isEmpty())
        <div class="card-body">
            <h1 class="mt-4">Host Table</h1>
            <p class="ml-2">No Host found.</p>
        </div>
    @else
    <div class="content-wrapper">
        <div class="row">
            @foreach ($hosts as $host)
                <div class="col-lg-6 col-xl-4 col-xxl-3 mx-4"> 
                    <div class="card card-default mt-7">
                        <div class="card-body text-center ">
                            <a class="d-block mb-2" href="javascript:void(0)" data-toggle="modal" data-target="#modal-host-{{ $host->id }}">
                                <div class="image mb-3 d-inline-flex mt-n8">
                                    <img src="{{ $host->profilePicture ? asset( $host->profilePicture) : 'https://ui-avatars.com/api/?name=' . ucfirst($host->username[0]) }}" class="img-fluid rounded-circle profile-image" alt="Avatar Image">
                                </div>
                                <h5 class="card-title name">{{ $host->username }}</h5>
                            </a>
                            <ul class="list-unstyled d-inline-block mb-5">
                                <li class="d-flex mb-1">
                                    <i class="mdi mdi-phone mr-1"></i>
                                    <span>{{ $host->phone_number ? preg_replace('/(\d{3})(\d{3})(\d{4})/', '$1-$2-$3', $host->phone_number) : 'N/A' }}</span>

                                </li>
                                <li class="d-flex">
                                    <i class="mdi mdi-email mr-1"></i>
                                    <span>{{ $host->user->email }}</span>
                                </li>
                            </ul>

                            <!-- Display Social Media Icons -->
                            @if($host->facebook || $host->instagram || $host->telegram || $host->tiktok)
                                <div class="row justify-content-center mt-1">
                                    @if($host->facebook)
                                    <div class="col-auto">
                                        <a href="https://www.facebook.com/{{ $host->facebook }}" target="_blank">
                                            <i class="myIconF mdi mdi-facebook-box"></i>
                                        </a>
                                    </div>
                                    @endif
                                    @if($host->instagram)
                                    <div class="col-auto">
                                        <a href="https://www.instagram.com/{{ $host->instagram }}" target="_blank">
                                            <i class="myIconI mdi mdi-instagram"></i>
                                        </a>
                                    </div>
                                    @endif
                                    @if($host->telegram)
                                    <div class="col-auto">
                                        <a href="https://www.telegram.com/{{ $host->telegram }}" target="_blank">
                                            <i class="myIconT mdi mdi-telegram"></i> 
                                        </a>
                                    </div>
                                    @endif
                                    @if($host->tiktok)
                                    <div class="col-auto mt-2">
                                        <a href="https://www.tiktok.com/{{ $host->tiktok }}" target="_blank">
                                           <img src="{{ asset('images/tik-tok.png') }}" alt="tiktok" class="tiktok-icon">
                                        </a>
                                    </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            
                <!-- Modal for Each Host -->
            <div class=" modal fade" id="modal-host-{{ $host->id }}" tabindex="-1" role="dialog" aria-labelledby="hostModalLabel{{ $host->id }}" aria-hidden="true ">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="hostModalLabel{{ $host->id }}">
                                {{ $host->username }}'s Details
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <!-- Profile Image and Basic Info -->
                                <div class="col-md-4 text-center">
                                    <img class="rounded-circle profile-image-modal mb-3" src="{{ $host->profilePicture ? asset( $host->profilePicture) : 'https://ui-avatars.com/api/?name=' . ucfirst($host->username[0]) }}" alt="Profile Image" style="width: 150px; height: 150px;">
                                    <h4 class="font-weight-bold">{{ $host->username }}</h4>
                                    <span class="badge badge-primary">Rating: {{ $host->rating ?? '4.6' }}</span>
                                    <span class="badge badge-primary">Number of listings: {{ $host->listings->count() }}</span>

                                </div>
                                
                                <!-- Detailed Information -->
                                <div class="col-md-8">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <p><i class="fas fa-envelope"></i> Email: <strong>{{ $host->user->email }}</strong></p>
                                            <p><i class="fas fa-phone"></i> Phone: <strong>{{ $host->phone_number ? preg_replace('/(\d{3})(\d{3})(\d{4})/', '$1-$2-$3', $host->phone_number) : 'N/A' }}</strong></p>
                                            <p><i class="fas fa-info-circle"></i> Description: <strong>{{ $host->hostDescription ?? 'N/A' }}</strong></p>
                                            <p><i class="fas fa-globe"></i> Country: <strong>{{ $host->country }}</strong></p>
                                            <p><i class="fas fa-map-marker-alt"></i> Region: <strong>{{ $host->region }}</strong></p>
                                            <p><i class="fas fa-city"></i> City: <strong>{{ $host->city }}</strong></p>
                                        </div>
                                    </div>
                                    
                                    <!-- Social Media Links -->
                                            
                                    <div class="info-card mb-3 p-3">
                                        <p><i class="fab fa-facebook mr-2" style="color: #3b5998;"></i> Facebook: <strong style="color: #3b5998;">{{ $host->facebook ?? 'N/A' }}</strong></p>
                                        <p><i class="fab fa-instagram mr-2 text-danger"></i> Instagram: <strong>{{ $host->instagram ?? 'N/A' }}</strong></p>
                                        <p><i class="fab fa-telegram mr-2 text-info"></i> Telegram: <strong>{{ $host->telegram ?? 'N/A' }}</strong></p>
                                        <p><i class="fab fa-tiktok mr-2 text-dark"></i> TikTok: <strong>{{ $host->tiktok ?? 'N/A' }}</strong></p>
                                    </div>

                                    <!-- ID Images -->
                                    <div class="card mb-3">
                                        <div class="card-body text-center">
                                            <h5>ID Images</h5>
                                            <div class="d-flex justify-content-around">
                                                <div>
                                                    <label>Front ID Image</label><br>
                                                    <img class="img-fluid" src="{{ $host->frontIdImage ? asset( $host->frontIdImage) : 'https://via.placeholder.com/150' }}" alt="Front ID Image" style="width: 100px;">
                                                </div>
                                                <div>
                                                    <label>Back ID Image</label><br>
                                                    <img class="img-fluid" src="{{ $host->backIdImage ? asset( $host->backIdImage) : 'https://via.placeholder.com/150' }}" alt="Back ID Image" style="width: 100px;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Verification Section -->
                                    <div class="text-right">
                                        <form method="POST" action="{{ route('host.verify', $host->id) }}">
                                            @csrf
                                            @method("PUT")
                                            <button type="submit" class="btn btn-outline-{{ $host->isVerified ? 'danger' : 'success' }} shadow-sm transition-all duration-300 ease-in-out hover:bg-gradient hover:text-white">
                                                {{ $host->isVerified ? 'Unverify' : 'Verify' }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
</div>

            @endforeach
        </div> <!-- End of row -->
    </div> <!-- End of content-wrapper -->
    @endif
</main>

<style>
/* Fixed Image Sizes */
.profile-image {
    width: 100px;
    height: 100px;
    object-fit: cover;
}
.profile-image-modal {
    width: 150px;
    height: 150px;
    object-fit: cover;
}

.name { 
    font-size: 1.5rem;
    font-weight: bold;
    color:#9e6de0;
}
.myIconI,
.myIconF,
.myIconT,
.myIcont {
    font-size: 30px;
    transition: color 0.3s ease, transform 0.3s ease; 
}
.myIconI {
    color: #fe5eb9;
}
.myIconF {
    color: #4867aa;
}
.myIconT {
    color: #26a4e4;
}
.myIcont {
    color: black;
}

/* Hovers */
.myIconI:hover {
    color: #bd478a;
}
.myIconF:hover {
    color: #374e82;
}
.myIconT:hover {
    color: #2180b0;
}
.myIcont:hover {
    color: rgb(82, 81, 81);
}

/* Social Media Icon Size */
.tiktok-icon{
    max-width: 25px;
    max-height: 25px;
}
</style>


@endsection
