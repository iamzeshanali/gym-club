@extends('dashboard.layouts.index')
@section('title', 'GymBook | Members')
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
                            <h5 class="breadcrumbs-title mt-0 mb-0 display-inline hide-on-small-and-down"><span>Members</span></h5>
                            <ol class="breadcrumbs mb-0">
                                <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('dashboard.members.index')}}">Members</a>
                                </li>
                                <li class="breadcrumb-item active"> {{ isset($member) ? 'Edit' : 'Add' }} Member
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s12">
            <div class="container">
                <form id="accountForm" action="{{ isset($member) ? route('dashboard.members.update', $member) : route('dashboard.members.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @if(isset($member))
                        @method('PUT')
                    @endif
                    <div class="row">
                        <div class="col s12">
                            <div class="row mb-4">
                                <div class="col s12 m4 mt-2">
                                    <div class="display-flex justify-content-between">
                                        <div class="media">
                                            @if(isset($member))
                                                <img src=" {{ isset($member->image) ? url('images/'.$member->image) : url('images/unknown.jpg')}}" id="preview-image" class="border-radius-4" alt="profile image"
                                                     height="64" width="64">
                                            @else
                                                <img src="{{ asset('images/avatar/avatar-12.png') }}" id="preview-image" class="border-radius-4" alt="profile image"
                                                     height="64" width="64">
                                            @endif

                                        </div>
                                        <div class="media-body">
                                            <div class="general-action-btn display-flex">
                                                <button id="select-files" class="btn indigo mr-2">
                                                    @if(isset($member))
                                                        {{isset($member->image) ? $member->image : 'Upload new photo'}}
                                                    @else
                                                        Upload new photo
                                                    @endif

                                                </button>
                                                <button class="btn btn-light-pink" id="reset">Reset</button>
                                            </div>
                                            <small id="file-content">Allowed JPG, GIF or PNG. Max size of 800kB</small>
                                            <div class="upfilewrapper display-none">
                                                <input id="upfile" accept="image/*" type="file" name="member_image" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col s12 m6">

                            <div class="row">
                                <div class="col s12 input-field">
                                    <i class="material-icons prefix">group</i>
                                    <select name="club">
                                        @foreach($clubs as $club)
                                            @if(isset($member))
                                                <option value="{{$club->id}}" {{$member->club->id == $club->id ? 'selected' : ''}}>{{$club->club_name}}</option>
                                            @else
                                                <option value="{{$club->id}}">{{$club->club_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <label>Club</label>
                                    <small class="errorTxt3" style="color: red">@error('club') {{$message}} @enderror</small>
                                </div>
                                <div class="col s12 input-field">
                                    <i class="material-icons prefix">person_pin</i>
                                    <input id="member_code" name="member_code" type="text" class="validate" value="{{ isset($member) ? $member->member_code : old('member_code') }}"
                                           data-error=".errorTxt2">
                                    <label for="member_code">Member Code</label>
                                    <small class="errorTxt2" style="color: red">@error('member_code') {{$message}} @enderror</small>
                                </div>
                                <div class="col s12 input-field">
                                    <i class="material-icons prefix">person_pin</i>
                                    <input id="name" name="name" type="text" class="validate" value="{{ isset($member) ? $member->name : old('name') }}"
                                           data-error=".errorTxt2">
                                    <label for="name">Name</label>
                                    <small class="errorTxt2" style="color: red">@error('name') {{$message}} @enderror</small>
                                </div>
                                <div class="col s12 input-field">
                                    <i class="material-icons prefix">email</i>
                                    <input id="email" name="email" type="email" class="validate" value="{{ isset($member) ? $member->email : old('email') }}"
                                           data-error=".errorTxt3">
                                    <label for="email">E-mail</label>
                                    <small class="errorTxt3" style="color: red">@error('email') {{$message}} @enderror</small>
                                </div>
                                <div class="col s12 input-field">
                                    <i class="material-icons prefix">phone</i>
                                    <input id="mobile" name="mobile" type="tel" class="validate" value="{{ isset($member) ? $member->mobile : old('mobile') }}"
                                           data-error=".errorTxt3">
                                    <label for="mobile">Mobile</label>
                                    <small class="errorTxt3" style="color: red">@error('mobile') {{$message}} @enderror</small>
                                </div>
                                <div class="col s12 input-field">
                                    <i class="material-icons prefix">mode_edit</i>
                                    <input id="dob" name="dob" type="date" value="{{ isset($member) ? $member->dob : old('dob') }}"
                                           data-error=".errorTxt3">
                                    <label for="dob">Date of Birth</label>
                                    <small class="errorTxt3" style="color: red">@error('dob') {{$message}} @enderror</small>
                                </div>
                                <div class="col s12 input-field">
                                    <i class="material-icons prefix">group</i>
                                    <select name="gender">
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                    <label>Gender</label>
                                    <small class="errorTxt3" style="color: red">@error('gender') {{$message}} @enderror</small>
                                </div>
                                <div class="col s12 input-field">
                                    <i class="material-icons prefix">group</i>
                                    <select name="member_type">
                                        <option value="visitor">Visitor</option>
                                        <option value="permanent">Permanent</option>
                                    </select>
                                    <label>Member Type</label>
                                    <small class="errorTxt3" style="color: red">@error('member_type') {{$message}} @enderror</small>
                                </div>
                                <div class="col s12 input-field">
                                    <i class="material-icons prefix">group</i>
                                    <select name="member_role">
                                        <option value="trainer">Trainer</option>
                                        <option value="staff">Staff</option>
                                    </select>
                                    <label>Member Role</label>
                                    <small class="errorTxt3" style="color: red">@error('member_role') {{$message}} @enderror</small>
                                </div>
                            </div>
                        </div>
                        <div class="col s12 m6">
                            <div class="row">
                                @if(\Illuminate\Support\Facades\Auth::user()->role->name == 'admin')
                                    <div class="col s12 input-field">
                                        <i class="material-icons prefix">group</i>
                                        <select name="status">
                                            <option value="approved">Approved</option>
                                            <option value="pending">Pending</option>
                                        </select>
                                        <label>Status</label>
                                        <small class="errorTxt3" style="color: red">@error('status') {{$message}} @enderror</small>
                                    </div>
                                @endif
                                <div class="col s12 input-field">
                                    <i class="material-icons prefix">group</i>
                                    <select name="enrollment_type">
                                        <option value="visitor">Visitor</option>
                                        <option value="confirmed">Confirmed</option>
                                    </select>
                                    <label>Enrollment Type</label>
                                    <small class="errorTxt3" style="color: red">@error('enrollment_status') {{$message}} @enderror</small>
                                </div>
                                    <div class="col s12 input-field">
                                        <i class="material-icons prefix">person_pin</i>
                                        <input id="enrollment_date" name="enrollment_date" type="date" value="{{ isset($member) ? $member->enrollment_date : old('enrollment_date') }}"
                                               data-error=".errorTxt2">
                                        <label for="enrollment_date">Enrollment Date</label>
                                        <small class="errorTxt2" style="color: red">@error('enrollment_date') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col s12 input-field">
                                        <i class="material-icons prefix">group</i>
                                        <select name="membership">
                                            @foreach($memberships as $membership)
                                                @if(isset($member))
                                                    <option value="{{$membership->id}}" {{$membership->id == $member->membership->id ? 'selected' : ''}}>{{$membership->description}}</option>
                                                @else
                                                    <option value="{{$membership->id}}">{{$membership->description}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <label>Membership</label>
                                        <small class="errorTxt3" style="color: red">@error('enrollment_status') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col s12 input-field">
                                        <i class="material-icons prefix">person_pin</i>
                                        <input id="start_date" name="start_date" type="date" value="{{ isset($member) ? $member->start_date : old('start_date') }}"
                                               data-error=".errorTxt2">
                                        <label for="start_date">Start Date</label>
                                        <small class="errorTxt2" style="color: red">@error('start_date') {{$message}} @enderror</small>
                                    </div>
                                <div class="col s12 input-field">
                                    <i class="material-icons prefix">mode_edit</i>
                                    <textarea id="comment" name="comment" class="materialize-textarea">{{ isset($member) ? $member->comments : old('comment') }}</textarea>
                                    <label for="comment">Comments</label>
                                    <small class="errorTxt3" style="color: red">@error('comments') {{$message}} @enderror</small>
                                </div>
                                <div class="col s12 input-field">
                                    <i class="material-icons prefix">mode_edit</i>
                                    <textarea id="note" name="note" class="materialize-textarea">{{ isset($member) ? $member->note : old('note') }}</textarea>
                                    <label for="note">Note</label>
                                    <small class="errorTxt3" style="color: red">@error('note') {{$message}} @enderror</small>
                                </div>

                            </div>
                        </div>
                        <div class="col s12 display-flex justify-content-end mt-3 mb-3">
                            <button type="submit" class="btn indigo">
                                Save changes</button>
                            <button type="button" class="btn btn-light">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="content-overlay"></div>
        </div>
    </div>
@endsection

@section('page-scripts')
    <script defer>

        $(document).ready(function () {
            $('.datepicker').datepicker();
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
    </script>



@endsection
