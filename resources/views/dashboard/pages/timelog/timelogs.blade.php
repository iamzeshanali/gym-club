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
                                    <form id="search-form" action="{{ route('dashboard.timelogs.store') }}" method="post">
                                        @csrf
                                    <input list="vendor" autocomplete="off"  type="text" placeholder="Search with Member Name/ Email/ Mobile..." id="search" name="search"
                                           class="search-box" style="width:80%;padding-left: 15px;border-radius: 50px; box-shadow: 3px 3px 14px #455a64;">

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
                                                        <th>In Time</th>
                                                        <th>Out Time</th>
                                                        <th>Time Spent</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($timelogs as $timelog)
                                                        <tr>
                                                            <td>
                                                                    <div class="chip gradient-45deg-purple-deep-orange white-text">
                                                                    <img src="{{ isset($timelog->member->image) ? url('images/'.$timelog->member->image) : url('images/unknown.jpg')}}" alt="Contact Person">
                                                                    {{ $timelog->member->name}}
                                                                </div>
                                                            </td>
                                                            <td>{{$timelog->time_in}}</td>
                                                            <td>
                                                                @if($timelog->time_out == "0")
                                                                    <a href="{{ route('dashboard.timelogs.edit', $timelog->id) }}" class="btn gradient-45deg-purple-deep-orange mr-4">Check Out</a>
                                                                @else
                                                                    {{$timelog->time_out}}
                                                                @endif
                                                            </td>
                                                            <td>{{$timelog->timespent}}</td>
                                                            <td>
                                                                <div class="invoice-action">
                                                                    <form
                                                                        id="del-form-{{$timelog->id}}"
                                                                        method="post"
                                                                        action="{{route('dashboard.timelogs.destroy', $timelog->id)}}" style="display: inline !important;">
                                                                        @csrf
                                                                        @method('DELETE')

                                                                        <a class="invoice-action-edit" onclick="confirmDelete({{$timelog->id}})" style="cursor: pointer">
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
                                                        <th>User</th>
                                                        <th>In Time</th>
                                                        <th>Out Time</th>
                                                        <th>Time Spent</th>
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
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this imaginary file!",
                icon: 'warning',
                dangerMode: true,
                timer: 3000
            }).then( () => {
                $('#search-form').submit();
            });

        }
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
