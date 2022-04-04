@extends('dashboard.layouts.index')
@section('title', 'GymBook | Roles')
@section('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/flag-icon/css/flag-icon.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/themes/vertical-modern-menu-template/materialize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/themes/vertical-modern-menu-template/style.css') }}">
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
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.roles.index') }}">Roles</a>
                                </li>
                                <li class="breadcrumb-item active"> {{ isset($role) ? 'Edit' : 'Add' }} Role
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s12">
            <div class="container">
                <div class="row">
                    <div class="col s12">
                        <form id="accountForm" action="{{ isset($role) ? route('dashboard.roles.update', $role) : route('dashboard.roles.store') }}" method="post">
                            @csrf
                            @if(isset($role))
                                @method('PUT')
                            @endif

                            <div class="row">
                                <div class="col s12 ">
                                    <div class="row">
                                        <div class="col s12 m6 input-field">
                                            <input id="name" name="name" type="text" class="validate" value="{{isset($role) ? $role->name : ''}}" required>
                                            <label for="username">Name</label>
                                            <small class="errorTxt1"></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 display-flex justify-content-end mt-3 m6">
                                    <button type="submit" class="btn indigo">
                                        Save changes</button>
                                    <button type="button" class="btn btn-light">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
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
