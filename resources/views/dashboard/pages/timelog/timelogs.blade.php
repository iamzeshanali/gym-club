@extends('dashboard.layouts.index')
@section('title', 'GymBook | TimeLog')
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
                    <div class="row knowledge-content">
                        <div class="col s12">
                            <div id="search-wrapper" class="card z-depth-0 search-image center-align p-35">
                                <div class="card-content">
                                    <h5 class="center-align mb-3">How can we help you?</h5>
                                    <form id="search-form" action="{{ route('dashboard.timelogs.index') }}" >
                                    <input list="vendor" autocomplete="off"  type="text" placeholder="Search with Member Name/ Email/ Mobile..." id="search" name="search"
                                           class="search-box" style="width:80%;padding-left: 15px;border-radius: 0%; box-shadow: 3px 3px 14px #455a64;">

                                    <datalist id="vendor">
                                        @foreach($members as $member)
                                            <option>
                                                {{$member->name}} |
                                                {{$member->email}} |
                                                {{$member->mobile}}
                                            </option>
                                        @endforeach
                                    </datalist>
                                    <a onclick="submitSearchForm()" class="btn gradient-45deg-purple-deep-orange mr-4 ml-2">Check In
                                    </a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s12">
                <div class="container">
                    <div class="section section-data-tables">
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
                                                        <th>User</th>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Mobile</th>

                                                        <th>Actions</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($members as $member)
                                                        <tr>
                                                            <td>
                                                                <span class="avatar-contact avatar-online">
                                                                    <img src="{{ isset($member->image) ? url('images/'.$member->image) : url('images/unknown.jpg')}}" alt="avatar">
                                                                </span>
                                                            </td>
                                                            <td>{{$member->name}}</td>
                                                            <td>{{$member->email}}</td>
                                                            <td>{{$member->mobile}}</td>
                                                            <td>
                                                                <div class="invoice-action">
                                                                    <a href="{{ route('dashboard.members.edit', $member->id) }}" class="btn gradient-45deg-purple-deep-orange mr-4">Check In
                                                                    </a>
                                                                </div>
                                                            </td>


                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <th>User</th>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Mobile</th>

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
        function submitSearchForm(){
            $('#search-form').submit();
        }


    </script>
    <script src="{{ asset('vendors/data-tables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('vendors/data-tables/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('js/scripts/data-tables.js') }}"></script>

@endsection
