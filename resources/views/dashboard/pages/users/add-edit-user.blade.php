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
                <div class="row">
                    <div class="col s12">
                        <form id="accountForm">
                            <div class="row">
                                <div class="col s12 m6">
                                    <div class="row">
                                        <div class="col s12 input-field">
                                            <input id="username" name="username" type="text" class="validate" value="dean3004"
                                                   data-error=".errorTxt1">
                                            <label for="username">Username</label>
                                            <small class="errorTxt1"></small>
                                        </div>
                                        <div class="col s12 input-field">
                                            <input id="name" name="name" type="text" class="validate" value="Dean Stanley"
                                                   data-error=".errorTxt2">
                                            <label for="name">Name</label>
                                            <small class="errorTxt2"></small>
                                        </div>
                                        <div class="col s12 input-field">
                                            <input id="email" name="email" type="email" class="validate" value="deanstanley@gmail.com"
                                                   data-error=".errorTxt3">
                                            <label for="email">E-mail</label>
                                            <small class="errorTxt3"></small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12 m6">
                                    <div class="row">
                                        <div class="col s12 input-field">
                                            <select>
                                                <option>User</option>
                                                <option>Staff</option>
                                            </select>
                                            <label>Role</label>
                                        </div>
                                        <div class="col s12 input-field">
                                            <select>
                                                <option>Active</option>
                                                <option>Banned</option>
                                                <option>Close</option>
                                            </select>
                                            <label>Status</label>
                                        </div>
                                        <div class="col s12 input-field">
                                            <input id="company" name="company" type="text" class="validate">
                                            <label for="company">Company</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12">
                                    <table class="mt-1">
                                        <thead>
                                        <tr>
                                            <th>Module Permission</th>
                                            <th>Read</th>
                                            <th>Write</th>
                                            <th>Create</th>
                                            <th>Delete</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Users</td>
                                            <td>
                                                <label>
                                                    <input type="checkbox" checked />
                                                    <span></span>
                                                </label>
                                            </td>
                                            <td>
                                                <label>
                                                    <input type="checkbox" />
                                                    <span></span>
                                                </label>
                                            </td>
                                            <td>
                                                <label>
                                                    <input type="checkbox" />
                                                    <span></span>
                                                </label>
                                            </td>
                                            <td>
                                                <label>
                                                    <input type="checkbox" checked />
                                                    <span></span>
                                                </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Articles</td>
                                            <td>
                                                <label>
                                                    <input type="checkbox" />
                                                    <span></span>
                                                </label>
                                            </td>
                                            <td>
                                                <label>
                                                    <input type="checkbox" checked />
                                                    <span></span>
                                                </label>
                                            </td>
                                            <td>
                                                <label>
                                                    <input type="checkbox" />
                                                    <span></span>
                                                </label>
                                            </td>
                                            <td>
                                                <label>
                                                    <input type="checkbox" checked />
                                                    <span></span>
                                                </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Staff</td>
                                            <td>
                                                <label>
                                                    <input type="checkbox" checked />
                                                    <span></span>
                                                </label>
                                            </td>
                                            <td>
                                                <label>
                                                    <input type="checkbox" checked />
                                                    <span></span>
                                                </label>
                                            </td>
                                            <td>
                                                <label>
                                                    <input type="checkbox" />
                                                    <span></span>
                                                </label>
                                            </td>
                                            <td>
                                                <label>
                                                    <input type="checkbox" />
                                                    <span></span>
                                                </label>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <!-- </div> -->
                                </div>
                                <div class="col s12 display-flex justify-content-end mt-3">
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
