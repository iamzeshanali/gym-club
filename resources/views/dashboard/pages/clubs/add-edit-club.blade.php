@extends('dashboard.layouts.index')
@section('title', 'GymBook | Clubs')
@section('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/flag-icon/css/flag-icon.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/themes/vertical-modern-menu-template/materialize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/themes/vertical-modern-menu-template/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/pages/page-account-settings.css') }}">

@endsection

@section('content')
    <div id="main">
        <div class="row">
            <div class="breadcrumbs-inline pt-2 " id="breadcrumbs-wrapper">
                <!-- Search for small screen-->
                <div class="container">
                    <div class="row">
                        <div class="col s10 m6 l6 breadcrumbs-left">
                            <h5 class="breadcrumbs-title mt-0 mb-0 display-inline hide-on-small-and-down"><span>Clubs</span></h5>
                            <ol class="breadcrumbs mb-0">
                                <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('dashboard.clubs.index')}}">Clubs</a>
                                </li>
                                <li class="breadcrumb-item active"> {{ isset($club) ? 'Edit' : 'Add' }} Club
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s12">
            <div class="container">
                <form id="accountForm" action="{{ isset($club) ? route('dashboard.clubs.update', $club) : route('dashboard.clubs.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @if(isset($club))
                        @method('PUT')
                    @endif
                    @error('club-limit-error')
                    <div class="card-alert card gradient-45deg-red-pink" id="error-alert">
                        <div class="card-content white-text">
                            <p>
                                <i class="material-icons">error</i> Failed : Your Clubs Creation Limit has Exceeds. Contact Admin</p>
                        </div>
                        <button type="button" onclick="document.getElementById('error-alert').style.display='none';return false;" class="close white-text" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    @enderror
                    <div class="row mt-4">
                        <div class="col s12 m6">

                            <div class="row">
                                <div class="col s12 input-field">
                                    <i class="material-icons prefix">person_pin</i>
                                    <input id="club_name" name="club_name" type="text" class="validate" value="{{ isset($club) ? $club->club_name : old('club_name') }}"
                                           data-error=".errorTxt2">
                                    <label for="club_name">Club Name</label>
                                    <small class="errorTxt2" style="color: red">@error('club_name') {{$message}} @enderror</small>
                                </div>
                                <div class="col s12 input-field">
                                    <i class="material-icons prefix">person_pin</i>
                                    <input id="contact_name" name="contact_name" type="text" class="validate" value="{{ isset($club) ? $club->contact_name : old('contact_name') }}"
                                           data-error=".errorTxt2">
                                    <label for="contact_name">Contact Name</label>
                                    <small class="errorTxt2" style="color: red">@error('contact_name') {{$message}} @enderror</small>
                                </div>
                                <div class="col s12 input-field">
                                    <i class="material-icons prefix">email</i>
                                    <input id="contact_email" name="contact_email" type="email" class="validate" value="{{ isset($club) ? $club->contact_email : old('contact_email') }}"
                                           data-error=".errorTxt3">
                                    <label for="contact_email">Contact E-mail</label>
                                    <small class="errorTxt3" style="color: red">@error('contact_email') {{$message}} @enderror</small>
                                </div>
                                <div class="col s12 input-field">
                                    <i class="material-icons prefix">phone</i>
                                    <input id="mobile" name="mobile" type="tel" class="validate" value="{{ isset($club) ? $club->mobile : old('mobile') }}"
                                           data-error=".errorTxt3">
                                    <label for="mobile">Mobile</label>
                                    <small class="errorTxt3" style="color: red">@error('mobile') {{$message}} @enderror</small>
                                </div>
                                @if(isset($countries))
                                    <div class="col s5 input-field">
                                        <i class="material-icons prefix">group</i>
                                        <select name="country" id="country">
                                            @foreach($countries as $country)
                                                <option value="approved">{{$country["name"]}} ({{$country['currency']}})</option>
                                            @endforeach
                                        </select>
                                        <label>Country</label>
                                        <small class="errorTxt3" style="color: red">@error('status') {{$message}} @enderror</small>
                                    </div>
                                @endif
                                <div class="col s5 input-field">
                                    <i class="material-icons prefix">group</i>
                                    <select name="city" id="city-input">
                                    </select>
                                    <label class="city-label">City</label>
                                    <small class="errorTxt3" style="color: red">@error('status') {{$message}} @enderror</small>
                                </div>
                                <div class="col s12 input-field">
                                    <i class="material-icons prefix">mode_edit</i>
                                    <textarea id="address" name="address" class="materialize-textarea">{{ isset($club) ? $club->address : old('address') }}</textarea>
                                    <label for="address">Address</label>
                                    <small class="errorTxt3" style="color: red">@error('address') {{$message}} @enderror</small>
                                </div>
                            </div>
                        </div>
                        <div class="col s12 m6">
                            <div class="row">
                                @if(\Illuminate\Support\Facades\Auth::user()->role->name == 'admin')
                                <div class="col s12 input-field">
                                    <i class="material-icons prefix">group</i>
                                    <select name="status" id="status">
                                        <option value="approved">Approved</option>
                                        <option value="pending">Pending</option>
                                    </select>
                                    <label>Status</label>
                                    <small class="errorTxt3" style="color: red">@error('status') {{$message}} @enderror</small>
                                </div>
                                @endif
                                <div class="col s12 input-field">
                                    <i class="material-icons prefix">group</i>
                                    <select name="type">
                                        @if(isset($club))
                                            <option value="Gym" {{$club->type == 'Gym' ? 'selected' : ''}}>Gym</option>
                                            <option value="Yoga Center" {{$club->type == 'Yoga Center' ? 'selected' : ''}}>Yoga Center</option>
                                            <option value="Fitness Club" {{$club->type == 'Fitness Club' ? 'selected' : ''}}>Fitness Club</option>
                                        @else
                                            <option value="Gym">Gym</option>
                                            <option value="Yoga Center">Yoga Center</option>
                                            <option value="Fitness Club">Fitness Club</option>
                                        @endif

                                    </select>
                                    <label>Type</label>
                                    <small class="errorTxt3" style="color: red">@error('type') {{$message}} @enderror</small>
                                </div>
                                <div class="col s12 input-field">
                                    <i class="material-icons prefix">mode_edit</i>
                                    <textarea id="comment" name="comment" class="materialize-textarea">{{ isset($club) ? $club->comment : old('comment') }}</textarea>
                                    <label for="comment">Comments</label>
                                    <small class="errorTxt3" style="color: red">@error('comments') {{$message}} @enderror</small>
                                </div>
                                <div class="col s12 input-field">
                                    <i class="material-icons prefix">mode_edit</i>
                                    <textarea id="note" name="note" class="materialize-textarea">{{ isset($club) ? $club->note : old('note') }}</textarea>
                                    <label for="note">Note</label>
                                    <small class="errorTxt3" style="color: red">@error('note') {{$message}} @enderror</small>
                                </div>
                            </div>
                        </div>
                        <div class="col s12 display-flex justify-content-end mt-3 mb-3">
                            <button type="submit" class="btn indigo">
                                Save changes</button>
                            <button type="button" class="btn btn-light" id="cancel">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="content-overlay"></div>
        </div>
    </div>
@endsection

@section('page-scripts')
    <script>
        $("#cancel").on("click", function (e) {
            e.preventDefault();
            location.reload(true);
        });
        $(document).ready(function () {
            // upload button converting into file button
            $("#select-files").on("click", function (e) {
                e.preventDefault();
                $("#upfile").click();
            });
            $('#upfile').change(function(e) {
                var fileName = e.target.files[0];
                if (fileName){
                    var reader = new FileReader();
                    reader.onload = function(){
                        $("#preview-image").attr("src", reader.result);
                    }
                    reader.readAsDataURL(fileName);
                }
                $("#select-files").text(e.target.files[0].name);
                $("#select-files").prop('disabled', true);

            });

            $("#reset").on("click", function (e) {
                e.preventDefault();
                $("#upfile").val("");
                $("#preview-image").attr("src", "/images/avatar/avatar-12.png");
                $("#select-files").prop('disabled', false);
                $("#select-files").text("Upload New");
            });
        });
        $('#country').on('change',function(){

            //var optionValue = $(this).val();
            //var optionText = $('#dropdownList option[value="'+optionValue+'"]').text();
            var input = $("#country option:selected").text();
            var country = input.split("(")[0];
            country = country.trim();
            // alert("Selected Option Text: "+country);
            $.ajax({
                url: 'https://countriesnow.space/api/v0.1/countries/cities',
                type: "POST",
                dataType: "json",
                data: {
                    country: country,
                },
                success: function (data) {
                    $.each(data['data'], function(index, value){
                        // console.log(value);
                        $('#city-input').append(new Option("value", "ioio"));
                    })

                }
            });
        });
    </script>



@endsection
