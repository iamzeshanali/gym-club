@extends('dashboard.layouts.index')
@section('title', 'GymBook | User Config')
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
                            <h5 class="breadcrumbs-title mt-0 mb-0 display-inline hide-on-small-and-down"><span>Users</span></h5>
                            <ol class="breadcrumbs mb-0">
                                <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('dashboard.user-clubs-config.index')}}">Configs</a>
                                </li>
                                <li class="breadcrumb-item active"> {{ isset($user) ? 'Edit' : 'Add' }} Config
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s12">
            <div class="container display-flex justify-content-center">
                <form id="accountForm" action="{{ isset($config) ? route('dashboard.user-clubs-config.update', $config) : route('dashboard.user-clubs-config.store') }}" method="post">
                    @csrf
                    @if(isset($config))
                        @method('PUT')
                    @endif
                    <div class="row">
                        <div class="col s12 m6">
                            @error('user-error')
                            <div class="card-alert card gradient-45deg-red-pink" id="error-alert">
                                <div class="card-content white-text">
                                    <p>
                                        <i class="material-icons">error</i> Failed : Selected User Configurations Already Exist.</p>
                                </div>
                                <button type="button" onclick="document.getElementById('error-alert').style.display='none';return false;" class="close white-text" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            @enderror
                            <div class="row">
                                <div class="col s12 input-field">
                                    <i class="material-icons prefix">group</i>
                                    <select name="user">
                                        @foreach($users as $user)
                                            @if(isset($config))
                                                <option value="{{$user->id}}" {{ $user->id == $config->user->id ? 'selected' : ''}}>{{ ucfirst($user->name) }}</option>
                                            @else
                                                <option value="{{$user->id}}">{{ ucfirst($user->name) }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <label>Users</label>
                                    <small class="errorTxt3" style="color: red">@error('user') {{$message}} @enderror</small>
                                </div>
                                <div class="col s12 input-field">
                                    <i class="material-icons prefix">email</i>
                                    <input id="max_clubs" name="max_clubs" type="number" class="validate" value="{{ isset($config) ? $config->max_clubs : old('max_clubs') }}"
                                           data-error=".errorTxt3">
                                    <label for="email">Max Clubs</label>
                                    <small class="errorTxt3" style="color: red">@error('max_clubs') {{$message}} @enderror</small>
                                </div>
                                <div class="col s12 input-field">
                                    <i class="material-icons prefix">phone</i>
                                    <input id="max_users" name="max_users" type="number" class="validate" value="{{ isset($config) ? $config->max_users : old('max_users') }}"
                                           data-error=".errorTxt3">
                                    <label for="email">Max Users</label>
                                    <small class="errorTxt3" style="color: red">@error('max_users') {{$message}} @enderror</small>
                                </div>
                                <div class="col s12 display-flex justify-content-end mt-3 mb-3">
                                    <button type="submit" class="btn indigo">
                                        Save changes</button>
                                    <button type="button" class="btn btn-light">Cancel</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="content-overlay"></div>
        </div>
    </div>
@endsection
