@extends('admin.layout.app')

@section('title', 'Hosts')

@section('content')

<main>
    <div class="content-wrapper">
        <div class="row">
            @foreach ($hosts as $host)
                <div class="col-lg-6 col-xl-4 col-xxl-3 mb-4"> <!-- Adjusted class for spacing -->
                    <div class="card card-default mt-7">
                        <div class="card-body text-center">
                            <a class="d-block mb-2" href="javascript:void(0)" data-toggle="modal" data-target="#modal-contact">
                                <div class="image mb-3 d-inline-flex mt-n8">
                                    <img src="{{ $host->profilePicture ? asset('host_profile/' . $host->profilePicture) : 'https://ui-avatars.com/api/?name=' . ucfirst($host->username[0]) }}" class="img-fluid rounded-circle d-inline-block" alt="Avatar Image">
                                </div>
                                <h5 class="card-title">{{ $host->username }}</h5>
                            </a>
        
                            <ul class="list-unstyled d-inline-block mb-5">
                                <li class="d-flex mb-1">
                                    <i class="mdi mdi-phone mr-1"></i>
                                    <span>
                                        {{ substr($host->phone_number, 0, 3) }}-{{ substr($host->phone_number, 3, 3) }}-{{ substr($host->phone_number, 6) }}
                                    </span>
                                </li>
                                <li class="d-flex">
                                    <i class="mdi mdi-email mr-1"></i>
                                    <span>{{ $host->user->email }}</span>
                                </li>
                            </ul> 
        
                            <div class="row justify-content-center">
                                <div class="col-4 px-1">
                                    <div class="circle" data-size="60" data-value="0.90" data-thickness="4" data-fill="{ &quot;color&quot;: &quot;#35D00E&quot; }">
                                        <div class="circle-content">
                                            <h6 class="text-uppercase">html</h6>
                                            <h6>90%</h6>
                                            <strong></strong>
                                        </div>
                                    </div>
                                </div>
        
                                <div class="col-4 px-1">
                                    <div class="circle" data-size="60" data-value="0.65" data-thickness="4" data-fill="{ &quot;color&quot;: &quot;#fec400&quot; }">
                                        <div class="circle-content">
                                            <h6 class="text-uppercase">css</h6>
                                            <h6>65%</h6>
                                            <strong></strong>
                                        </div>
                                    </div>
                                </div>
        
                                <div class="col-4 px-1">
                                    <div class="circle" data-size="60" data-value="0.35" data-thickness="4" data-fill="{ &quot;color&quot;: &quot;#fe5461&quot; }">
                                        <div class="circle-content">
                                            <h6 class="text-uppercase">js</h6>
                                            <h6>25%</h6>
                                            <strong></strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- End of individual card -->
            @endforeach
        </div> <!-- End of row -->
    </div> <!-- End of content-wrapper -->
</main>

@endsection
