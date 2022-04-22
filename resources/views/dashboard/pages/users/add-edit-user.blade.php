@extends('dashboard.layouts.index')
@section('title', 'GymBook | Roles')
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
                            <h5 class="breadcrumbs-title mt-0 mb-0 display-inline hide-on-small-and-down"><span>Team</span></h5>
                            <ol class="breadcrumbs mb-0">
                                <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('dashboard.users.index')}}">Team</a>
                                </li>
                                <li class="breadcrumb-item active"> {{ isset($user) ? 'Edit' : 'Add' }} Team
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s12">
            <div class="container">
                <form id="accountForm" action="{{ isset($user) ? route('dashboard.users.update', $user) : route('dashboard.users.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @if(isset($user))
                        @method('PUT')
                    @endif
                <div class="row">
                    <div class="col s12">
                        <div class="row mb-4">
                            <div class="col s12 m4 mt-2">
                                <div class="display-flex justify-content-between">
                                    <div class="media">
                                        @if(isset($user))
                                            <img src=" {{ isset($user->user_image) ? url('images/'.$user->user_image) : url('images/unknown.jpg')}}" id="preview-image" class="border-radius-4" alt="profile image"
                                                 height="64" width="64">
                                        @else
                                            <img src="{{ asset('images/avatar/avatar-12.png') }}" id="preview-image" class="border-radius-4" alt="profile image"
                                                 height="64" width="64">
                                        @endif

                                    </div>
                                    <div class="media-body">
                                        <div class="general-action-btn display-flex">
                                            <button id="select-files" class="btn indigo mr-2">
                                                @if(isset($user))
                                                    {{isset($user->user_image) ? $user->user_image : 'Upload new photo'}}
                                                @else
                                                    Upload new photo
                                                @endif

                                            </button>
                                            <button class="btn btn-light-pink" id="reset">Reset</button>
                                        </div>
                                        <small id="file-content">Allowed JPG, GIF or PNG. Max size of 800kB</small>
                                        <div class="upfilewrapper display-none">
                                            <input id="upfile" accept="image/*" type="file" name="user_image" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 m6">

                        <div class="row">
                            <div class="col s12 input-field">
                                <i class="material-icons prefix">person_pin</i>
                                <input id="name" name="name" type="text" class="validate" value="{{ isset($user) ? $user->name : old('name') }}"
                                       data-error=".errorTxt2">
                                <label for="name">Name</label>
                                <small class="errorTxt2" style="color: red">@error('name') {{$message}} @enderror</small>
                            </div>
                            <div class="col s12 input-field">
                                <i class="material-icons prefix">email</i>
                                <input id="email" name="email" type="email" class="validate" value="{{ isset($user) ? $user->email : old('email') }}"
                                       data-error=".errorTxt3">
                                <label for="email">E-mail</label>
                                <small class="errorTxt3" style="color: red">@error('email') {{$message}} @enderror</small>
                            </div>
                            <div class="col s12 input-field">
                                <i class="material-icons prefix">phone</i>
                                <input id="phone" name="phone" type="tel" class="validate" value="{{ isset($user) ? $user->phone : old('phone') }}"
                                       data-error=".errorTxt3">
                                <label for="email">Phone</label>
                                <small class="errorTxt3" style="color: red">@error('phone') {{$message}} @enderror</small>
                            </div>
                            <div class="col s12 input-field">
                                <i class="material-icons prefix">mode_edit</i>
                                <textarea id="comments" name="comments" class="materialize-textarea">{{ isset($user) ? $user->comments : old('comments') }}</textarea>
                                <label for="comments">Comments</label>
                                <small class="errorTxt3" style="color: red">@error('comments') {{$message}} @enderror</small>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m6">
                        <div class="row">
                            <div class="col s12 input-field">
                                <i class="material-icons prefix">group</i>
                                <select name="role">
                                    @foreach($roles as $role)
                                        @if(isset($user))
                                            <option {{ $user->role->nM == $role->name ? 'selected' : ''}}>{{ ucfirst($role->name) }}</option>
                                        @else
                                            <option value="{{$role->name}}">{{ ucfirst($role->name) }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <label>Role</label>
                                <small class="errorTxt3" style="color: red">@error('role') {{$message}} @enderror</small>
                            </div>
                            <div class="col s12 input-field">
                                <i class="material-icons prefix">lock_outline</i>
                                <input id="password" name="password" type="password" class="validate">
                                <label for="password">Password</label>
                                <small class="errorTxt3" style="color: red">@error('password') {{$message}} @enderror</small>
                            </div>
                            <div class="col s12 input-field">
                                <i class="material-icons prefix">lock_open</i>
                                <input id="password_confirmation" name="password_confirmation" type="password" class="validate">
                                <label for="password_confirmation">Confirm Password</label>
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
