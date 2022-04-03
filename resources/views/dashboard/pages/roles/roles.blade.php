@extends('dashboard.layouts.index')
@section('title', 'GymBook | Roles')
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
                <div class="breadcrumbs-inline pt-2 " id="breadcrumbs-wrapper">
                    <!-- Search for small screen-->
                    <div class="container">
                        <div class="row">
                            <div class="col s10 m6 l6 breadcrumbs-left">
                                <h5 class="breadcrumbs-title mt-0 mb-0 display-inline hide-on-small-and-down"><span>Roles</span></h5>
                                <ol class="breadcrumbs mb-0">
                                    <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Roles</a>
                                    </li>
                                    <li class="breadcrumb-item active">ViewAll
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s12">
                <div class="container">
                    <div class="section section-data-tables">
                        <a class="waves-effect waves-light btn gradient-45deg-purple-deep-orange z-depth-4 mr-1 mb-1 right" href="{{ route('dashboard.roles.create') }}">+ Add New Role</a>
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
                                                        <th>Name</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($roles as $role)
                                                        <tr>
                                                            <td>{{$role->name}}</td>
                                                            <td>
                                                                <div class="invoice-action">
                                                                    <a href="app-invoice-view.html" class="invoice-action-view mr-4">
                                                                        <i class="material-icons">remove_red_eye</i>
                                                                    </a>
                                                                    <a href="app-invoice-edit.html" class="invoice-action-edit">
                                                                        <i class="material-icons">edit</i>
                                                                    </a>
                                                                    <a href="app-invoice-edit.html" class="invoice-action-edit">
                                                                        <i class="material-icons">Delete</i>
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <th>Name</th>
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
@endsection

@section('page-scripts')
    <script src="{{ asset('vendors/data-tables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('vendors/data-tables/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('vendors/data-tables/js/datatables.checkboxes.min.js') }}"></script>

    <script src="{{ asset('js/scripts/data-tables.js') }}"></script>

@endsection
