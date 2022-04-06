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
        
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Update Vendor Password</h4>
                        <p class="card-description">
                            Basic form layout
                        </p>
                        <div class="form-group">
                            <label for="vendor_email">Vendor Username/Email</label>
                            <input type="text" class="form-control" value="{{$vendorDetails["vendor_personal"]["email"]}}" readonly="">
                        </div>
                        <div class="form-group">
                            <label for="vendor_name">Name</label>
                            <input type="text" class="form-control" value="{{$vendorDetails["vendor_personal"]["name"]}}" readonly="">
                        </div>
                        <div class="form-group">
                            <label for="vendor_address">Address</label>
                            <input type="text" class="form-control" value="{{$vendorDetails["vendor_personal"]["adress"]}}" readonly="">
                        </div>
                        <div class="form-group">
                            <label for="vendor_city">City</label>
                            <input type="text" class="form-control" value="{{$vendorDetails["vendor_personal"]["city"]}}" readonly="">
                        </div>
                        <div class="form-group">
                            <label for="vendor_state_country">State Country</label>
                            <input type="text" class="form-control" value="{{$vendorDetails["vendor_personal"]["state country"]}}" readonly="">
                        </div>
                        <div class="form-group">
                            <label for="vendor_pincode">Pincode</label>
                            <input type="text" class="form-control" value="{{$vendorDetails["vendor_personal"]["pincode"]}}" readonly="">
                        </div>
                        <div class="form-group">
                            <label for="vendor_mobile">Mobile</label>
                            <input type="text" class="form-control" value="{{$vendorDetails["vendor_personal"]["mobile"]}}" readonly="">
                        </div>
                        <div class="form-group">
                            <label for="vendor_image">Photo</label>
                            <div>
                                <img width="300" src="{{ url("admin/images/photos/".$vendorDetails["image"]) }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
    @include('admin.layout.footer')
    <!-- partial -->
</div>
@endsection