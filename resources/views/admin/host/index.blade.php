@extends('admin.layout.app')

@section('title', 'Hosts')

@section('content')

<main>
    @if ($hosts->isEmpty())
        <div class="card-body">
            <h1 class="mt-4">Hosts Table</h1>
            <p class="ml-2">No hosts found.</p>
        </div>
    @else
    <div class="content-wrapper p-4">
        <div class="row">
            @foreach ($hosts as $host)
                <div class="col-lg-6 col-xl-4 col-xxl-3 mb-4 myHostcard"> 
                    <div class="card card-default mt-7">
                        <div class="card-body text-center">
                            <a class="d-block mb-2" href="javascript:void(0)" data-toggle="modal" data-target="#modal-host-{{ $host->id }}">
                                <div class="image mb-3 d-inline-flex mt-n8">
                                    <img src="{{ $host->profilePicture ? asset($host->profilePicture) : 'https://ui-avatars.com/api/?name=' . ucfirst($host->username[0]) }}" 
                                    class="img-fluid rounded-circle d-inline-block" 
                                    style="width: 110px; height: 110px;" 
                                    alt="Avatar Image">
                                </div>
                                
                                <h5 class="card-title text-secondary font-weight-bold name">{{ $host->username }}</h5>
                            </a>
        
                            <ul class="list-unstyled d-inline-block mb-5">
                                <li class="d-flex mb-1">
                                    <i class="mdi mdi-phone mr-1"></i>
                                    <span>
                                        {{ $host->phone_number ? preg_replace('/(\d{3})(\d{3})(\d{4})/', '$1-$2-$3', $host->phone_number) : 'N/A' }}
                                    </span>
                                </li>
                                <li class="d-flex">
                                    <i class="mdi mdi-email mr-1"></i>
                                    <span>{{ $host->user->email }}</span>
                                </li>
                            </ul>

                            <!-- Display Social Media Icons -->
                            @if($host->facebook || $host->instagram || $host->telegram || $host->tiktok)
                                <div class="row justify-content-center mb-2 mt-2">
                                    
                                    {{-- facebook --}}
                                    @if($host->facebook)
                                    <div class="col-auto">
                                        <a href="https://www.facebook.com/{{ $host->facebook }}" target="_blank">
                                            <i class="myIconF mdi mdi-facebook-box"></i>
                                        </a>
                                    </div>
                                    @endif

                                    {{-- instagram --}}
                                    @if($host->instagram)
                                    <div class="col-auto">
                                        <a href="https://www.instagram.com/{{ $host->instagram }}" target="_blank">
                                            <i class="myIconI mdi mdi-instagram"></i>
                                        </a>
                                    </div>
                                    @endif

                                    {{-- telegram --}}
                                    @if($host->telegram)
                                    <div class="col-auto">
                                        <a href="https://www.telegram.com/{{ $host->telegram }}" target="_blank">
                                            <i class="myIconT mdi mdi-telegram"></i> 
                                        </a>
                                    </div>
                                    @endif

                                    {{-- tiktok --}}
                                    @if($host->tiktok)
                                    <div class="col-auto">
                                        <a href="https://www.tiktok.com/{{ $host->tiktok }}" target="_blank">
                                           <img src="{{ asset('images/tik-tok.png') }}" alt="tiktok" class="mt-2">
                                        </a>
                                    </div>
                                    @endif
                                </div>
                            @endif
                        
                        </div>
                    </div>
                </div>

                <!-- Modal for Each Host -->
                <div class="modal fade" id="modal-host-{{ $host->id }}" tabindex="-1" role="dialog" aria-labelledby="hostModalLabel{{ $host->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="hostModalLabel{{ $host->id }}">{{ $host->username }}'s Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <img class="rounded-circle" src="{{ $host->profilePicture ? asset($host->profilePicture) : 'https://ui-avatars.com/api/?name=' . ucfirst($host->username[0]) }}" alt="Profile Image" style="width: 150px; height: 150px;">
                                    </div>
                                    <div class="col-md-8">
                                        <h4>{{ $host->username }}</h4>
                                        <p>Email: {{ $host->user->email }}</p>
                                        <p>Phone: {{ $host->phone_number }}</p>
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
        </div>
    </div>
    @endif
</main>

<style>
.name { 
    font-size: 1.5rem;
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
</style>

{{-- <script>
$(document).ready(function() {
    $('.modal').on('click', function(event) {
        event.stopPropagation();
    });
});
</script> --}}

@endsection
