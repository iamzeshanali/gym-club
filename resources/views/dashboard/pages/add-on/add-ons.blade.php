@extends('dashboard.layouts.index')
@section('title', 'GymBook | AddOns')
@section('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/flag-icon/css/flag-icon.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/data-tables/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/data-tables/css/select.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/pages/data-tables.css') }}">
@endsection

@section('content')
    <div id="main">
        <div class="row">
            <div class="breadcrumbs-inline pt-3 pb-1" id="breadcrumbs-wrapper">
                <!-- Search for small screen-->
                <div class="container">
                    <div class="row">
                        <div class="col s10 m6 l6 breadcrumbs-left">
                            <h5 class="breadcrumbs-title mt-0 mb-0 display-inline hide-on-small-and-down"><span>AddOns</span></h5>
                            <ol class="breadcrumbs mb-0">
                                <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">AddOns</a>
                                </li>
                                <li class="breadcrumb-item active">ViewAll
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s12">
                <div class="container">
                    <div class="section section-data-tables">
                        <a class="waves-effect waves-light btn gradient-45deg-purple-deep-orange z-depth-4 mr-1 mb-1 right" href="{{ route('dashboard.addons.create') }}">+ Add New Subscription</a>
                        <!-- Page Length Options -->
                        <div class="row">
                            <div class="col s12">
                                <div class="card">
                                    <div class="card-content">
                                        <h4 class="card-title">View : : All</h4>
                                        <div class="row">
                                            <div class="col s12">
                                                <table id="page-length-option" class="display">
                                                    <thead>
                                                    <tr>
                                                        <th>Club</th>
                                                        <th>AddOn Code</th>
                                                        <th>AddOn Description</th>
                                                        <th>Status</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($addons as $addon)
                                                        <tr>
                                                            <td>
                                                                <div class="chip cyan white-text">{{ucfirst($addon->club->club_name)}}</div>
                                                            </td>
                                                            <td>{{$addon->add_on_code}}</td>
                                                            <td>{{$addon->add_on_description}}</td>
                                                            <td>
                                                                <div class="chip {{ $addon->status == 'pending' ? 'gradient-45deg-purple-deep-orange' : 'cyan' }} white-text">{{ucfirst($addon->status)}}</div>
                                                            </td>
                                                            <td>
                                                                <div class="invoice-action">
                                                                    <a href="{{ route('dashboard.addons.edit', $addon->id) }}" class="invoice-action-edit mr-4">
                                                                        <i class="material-icons" style="color: #6b26a1">edit</i>
                                                                    </a>

                                                                    <form
                                                                        id="del-form-{{$addon->id}}"
                                                                        method="post"
                                                                        action="{{route('dashboard.addons.destroy', $addon->id)}}" style="display: inline !important;">
                                                                        @csrf
                                                                        @method('DELETE')

                                                                        <a class="invoice-action-edit" onclick="confirmDelete({{$addon->id}})" style="cursor: pointer">
                                                                            <i class="material-icons"  style="color: #f1654d">delete</i>
                                                                        </a>
                                                                    </form>
                                                                </div>
                                                            </td>


                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <th>Club</th>
                                                        <th>AddOn Code</th>
                                                        <th>AddOn Description</th>
                                                        <th>Status</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div><!-- START RIGHT SIDEBAR NAV -->

                </div>
                <div class="content-overlay"></div>
            </div>
        </div>
    </div>
@endsection

@section('page-scripts')
    <script>
        function confirmDelete(id){
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this imaginary file!",
                icon: 'warning',
                dangerMode: true,
                buttons: {
                    cancel: 'No, Please!',
                    delete: 'Yes, Delete It'
                }
            }).then(function (willDelete) {
                if (willDelete) {
                    val_id = "#del-form-"+id;
                    // alert(val_id);
                    $(val_id).submit();

                    swal({
                        title: "Poof! Role "+data_id+" has been deleted!",
                        icon: "success",
                    });
                } else {
                    swal("Your imaginary file is safe", {
                        title: 'Cancelled',
                        icon: "error",
                    });
                }
            });

        }


    </script>
    <script src="{{ asset('vendors/data-tables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('vendors/data-tables/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('js/scripts/data-tables.js') }}"></script>

@endsection
