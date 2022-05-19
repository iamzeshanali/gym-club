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

                                    <input id="input-data" list="vendor" autocomplete="off"  type="text" placeholder="Search with Member Name/ Email/ Mobile..." id="search" name="search"
                                           class="search-box" style="width:80%;padding-left: 15px;border-radius: 50px; box-shadow: 3px 3px 14px #455a64;">

                                    <datalist id="vendor">
                                        @foreach($members as $member)
                                            <option>
                                                {{$member->name}} |
                                                {{$member->email}} |
                                                {{$member->mobile}}
                                            </option>
                                            <input type="hidden" value="{{ isset($member->image) ? url('images/'.$member->image) : url('images/unknown.jpg')}}" />
                                        @endforeach
                                    </datalist>

                                    <a onclick="Checkin()" class="btn gradient-45deg-purple-deep-orange mr-4 ml-2">Check In
                                    </a>
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
                                                                    <a onclick="checkout({{$timelog->id}},'{{$timelog->time_in}}','{{$timelog->member->name}}')" class="btn gradient-45deg-purple-deep-orange mr-4">Check Out</a>
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function parseTime(s) {
            var c = s.split(':');
            return parseInt(c[0]) * 60 + parseInt(c[1]);
        }
        function tConvert (time) {
            // Check correct time format and split into components
            time = time.toString ().match (/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [time];

            if (time.length > 1) { // If time format correct
                time = time.slice (1);  // Remove full string match value
                time[5] = +time[0] < 12 ? ' AM' : ' PM'; // Set AM/PM
                time[0] = +time[0] % 12 || 12; // Adjust hours
            }
            return time.join (''); // return adjusted time or original string
        }

        function diff(start, end) {
            start = start.split(":");
            end = end.split(":");
            var startDate = new Date(0, 0, 0, start[0], start[1], 0);
            var endDate = new Date(0, 0, 0, end[0], end[1], 0);
            var diff = endDate.getTime() - startDate.getTime();
            var hours = Math.floor(diff / 1000 / 60 / 60);
            diff -= hours * 1000 * 60 * 60;
            var minutes = Math.floor(diff / 1000 / 60);

            return (hours < 9 ? "0" : "") + hours + ":" + (minutes < 9 ? "0" : "") + minutes;
        }

        function checkout(id, timein, user){

            var today = new Date();
            var time = today.getHours() + ":" +  (today.getMinutes()<10?'0':'') + today.getMinutes() + ":" + today.getSeconds();

            console.log(timein);
            console.log(user);
            console.log(tConvert(time));

            var totalTime = diff(timein, tConvert(time));

            $.ajax({
                url: '{{ route('dashboard.timelogs.store') }}',
                type: "POST",
                dataType: "json",
                data: {
                    id: id,
                    checkedOut: tConvert(time),
                    timeSpent: totalTime
                },
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                success: function (data) {
                    console.log(data);
                    Swal.fire({
                        title: `Hi ${user} `,
                        html:
                            ' Checked out at - <b>'+ tConvert (time) + '</b> <br />  <b> Todays Time Spent is '+totalTime+' </b>' + '<br /> <br /> <b> Your past week average Time Spent is'+totalTime+' </b>',
                        imageUrl: 'https://unsplash.it/400/200',
                        imageWidth: 400,
                        imageHeight: 200,
                        imageAlt: 'Custom image',
                        timer: 5000,
                        timerProgressBar: true,
                    }).then((result) => {
                        window.location.reload();
                    });

                }
            });
        }

        function Checkin(){
            var today = new Date();
            var time = today.getHours() + ":" +  (today.getMinutes()<10?'0':'') + today.getMinutes() + ":" + today.getSeconds();
            // console.log(time);
            // console.log(tConvert (time));

            let inpuData = $("#input-data").val();
            let inpuId = $("#member_id").val();
            let inputImage =$("#member_image").val();
            inpuData = inpuData.split("|");
            let name = inpuData[0].trim();
            let email = inpuData[1].trim();
            let phone = inpuData[2].trim();
            let timerInterval
            Swal.fire({
                title: `Hi ${name} `,
                html:
                    ' <b> Welcome to the Club </b> <br /> <br /> Checked In at <b>'+ tConvert (time) + '</b>',
                imageUrl: 'https://unsplash.it/400/200',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
                timer: 5000,
                timerProgressBar: true,
                willClose: () => {
                    clearInterval(timerInterval)
                }
            }).then((result) => {

                $.ajax({
                    url: '{{ route('dashboard.timelogs.store') }}',
                    type: "POST",
                    dataType: "json",
                    data: {
                        name: name,
                        email: email,
                        checkedIn: tConvert(time),
                    },
                    headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    success: function (data) {
                       console.log(data);
                        window.location.reload();
                    }
                });
            });
        }
        function confirmDelete(id){
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    swalWithBootstrapButtons.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    );
                    val_id = "#del-form-"+id;
                    // alert(val_id);
                    $(val_id).submit();
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your imaginary file is safe :)',
                        'error'
                    )
                }
            })

        }


    </script>
    <script src="{{ asset('vendors/data-tables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('vendors/data-tables/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('js/scripts/data-tables.js') }}"></script>

@endsection
