@extends('admin.layout.layout')

@section("content")
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Settings</h3>
                    </div>
                    <div class="col-12 col-xl-4">
                        <div class="justify-content-end d-flex">
                            <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <i class="mdi mdi-calendar"></i> Today (10 Jan 2021)
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                                    <a class="dropdown-item" href="#">January - March</a>
                                    <a class="dropdown-item" href="#">March - June</a>
                                    <a class="dropdown-item" href="#">June - August</a>
                                    <a class="dropdown-item" href="#">August - November</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        @if( $slug=="personal" )
            <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Update Vendor Password</h4>
                            <p class="card-description">
                                Basic form layout
                            </p>
                            
                            @if( Session::has("error_message"))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Error: </strong> {{ Session::get("error_message") }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif
                            @if( Session::has("success_message"))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success: </strong> {{ Session::get("success_message") }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif

                            @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                                @endforeach
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif
                            
                            <form class="forms-sample" action="{{ url("admin/update-vendor-details/".$slug) }}" method="post" enctype="multipart/form-data">@csrf
                                <div class="form-group">
                                    <label for="vendor_email">Vendor Username/Email</label>
                                    <input type="text" name="vendor_email" id="vendor_email" class="form-control" value="{{ Auth::guard("admin")->user()->email }}" readonly="">
                                </div>
                                <div class="form-group">
                                    <label for="vendor_name">Name</label>
                                    <input type="text" name="vendor_name" id="vendor_name" class="form-control" value="{{ $vendorDetails["name"] }}">
                                </div>
                                <div class="form-group">
                                    <label for="vendor_address">Address</label>
                                    <input type="text" name="vendor_address" id="vendor_address" class="form-control" value="{{ $vendorDetails["adress"] }}">
                                </div>
                                <div class="form-group">
                                    <label for="vendor_city">City</label>
                                    <input type="text" name="vendor_city" id="vendor_city" class="form-control" value="{{ $vendorDetails["city"] }}">
                                </div>
                                <div class="form-group">
                                    <label for="vendor_state_country">State Country</label>
                                    <select class="form-control" name="vendor_state_country" id="vendor_state_country">
                                        @foreach ($country as $c )
                                        <option value="{{ $c["country_name"] }}"
                                        @if ( $c["country_name"] == $vendorDetails["state country"])
                                            selected
                                        @endif
                                        >{{ $c["country_name"] }}</option>
                                        @endforeach
                                    </select>
                                    
                                </div>
                                <div class="form-group">
                                    <label for="vendor_pincode">Pincode</label>
                                    <input type="text" name="vendor_pincode" id="vendor_pincode" class="form-control" value="{{ $vendorDetails["pincode"] }}">
                                </div>
                                <div class="form-group">
                                    <label for="vendor_mobile">Mobile</label>
                                    <input type="text" name="vendor_mobile" id="vendor_mobile" class="form-control" value="{{ $vendorDetails["mobile"] }}">
                                </div>
                                <div class="form-group">
                                    <label for="vendor_image">Photo</label>
                                    <input type="file" class="form-control" id="vendor_image" name="vendor_image">
                                    @if( Auth::guard('admin')->user()->image )
                                        <a href="{{ url("admin/images/photos/".Auth::guard("admin")->user()->image) }}" target="_blank">View</a>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <button class="btn btn-light">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @elseif( $slug=="business" )
        
        @elseif( $slug=="bank" )
        
        @endif
        
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
    @include('admin.layout.footer')
    <!-- partial -->
</div>
@endsection