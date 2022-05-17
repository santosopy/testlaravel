@extends('admin.layout.layout')

@section("content")
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Sections</h4>
                        {{-- <p class="card-description">
                            Add class <code>.table-bordered</code>
                        </p> --}}
                        <div class="table-responsive pt-3">
                            <table id="sections" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>
                                            Admin ID
                                        </th>
                                        <th>
                                            Name
                                        </th>
                                        <th>
                                            Status
                                        </th>
                                        <th>
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($sections as $section)
                                    <tr>
                                        <td>
                                            {{$section["id"]}}
                                        </td>
                                        <td>
                                            {{$section["name"]}}
                                        </td>
                                        <td>
                                            <a 
                                                class="statusSection" 
                                                data-id="{{ $section["id"] }}"
                                                data-status="{{ $section["status"] }}"
                                                href="javascript:void(0)"
                                                >
                                                @if( $section["status"]==1 )
                                                    <i class="mdi mdi-bookmark-plus"></i>
                                                @else
                                                    <i class="mdi mdi-bookmark-plus-outline "></i>
                                                @endif
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ url("admin/add-edit-section/".$section["id"]) }}">
                                                <i class="mdi mdi-pencil-box"></i>
                                            </a>
                                            <a href="{{ url("admin/delete-section/".$section["id"]) }}">
                                                <i class="mdi mdi-file-excel-box"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
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