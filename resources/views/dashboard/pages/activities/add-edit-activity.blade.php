@extends('dashboard.layouts.index')
@section('title', 'GymBook | Activities')
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
                        <h5 class="breadcrumbs-title mt-0 mb-0 display-inline hide-on-small-and-down"><span>Activities</span></h5>
                        <ol class="breadcrumbs mb-0">
                            <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{route('dashboard.activities.index')}}">Activities</a>
                            </li>
                            <li class="breadcrumb-item active"> {{ isset($activity) ? 'Edit' : 'Add' }} Activity
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col s12">
        <div class="container">
            <form id="accountForm" action="{{ isset($activity) ? route('dashboard.activities.update', $activity) : route('dashboard.activities.store') }}" method="post">
                @csrf
                @if(isset($activity))
                @method('PUT')
                @endif
                <div class="row mt-4">
                    <div class="col s12 m6">

                        <div class="row">
                            <div class="col s12 input-field">
                                <i class="material-icons prefix">group</i>
                                <select name="club">
                                    @foreach($clubs as $club)
                                    @if(isset($activity))
                                    <option value="{{$club->id}}" {{$activity->club->id == $club->id ? 'selected' : ''}}>{{$club->club_name}}</option>
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
                                <input id="activity_code" name="activity_code" type="text" class="validate" value="{{ isset($activity) ? $activity->activity_code : old('activity_code') }}"
                                       data-error=".errorTxt2">
                                <label for="activity_code">Activity Code</label>
                                <small class="errorTxt2" style="color: red">@error('activity_code') {{$message}} @enderror</small>
                            </div>
                            <div class="col s12 input-field">
                                <i class="material-icons prefix">person_pin</i>
                                <input id="activity_description" name="activity_description" type="text" class="validate" value="{{ isset($activity) ? $activity->activity_description : old('activity_description') }}"
                                       data-error=".errorTxt3">
                                <label for="activity_description">Activity Description</label>
                                <small class="errorTxt3" style="color: red">@error('activity_description') {{$message}} @enderror</small>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m6">
                        <div class="row">
                            @if(\Illuminate\Support\Facades\Auth::user()->role->name == 'owner')
                            <div class="col s12 input-field">
                                <i class="material-icons prefix">group</i>
                                <select name="status">
                                    <option value="active">Active</option>
                                    <option value="inactive">InActive</option>
                                </select>
                                <label>Status</label>
                                <small class="errorTxt3" style="color: red">@error('status') {{$message}} @enderror</small>
                            </div>
                            @endif
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

