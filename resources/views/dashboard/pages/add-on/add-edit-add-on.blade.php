@extends('dashboard.layouts.index')
@section('title', 'GymBook | AddOn')
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
                            <h5 class="breadcrumbs-title mt-0 mb-0 display-inline hide-on-small-and-down"><span>AddOns</span></h5>
                            <ol class="breadcrumbs mb-0">
                                <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('dashboard.addons.index')}}">AddOns</a>
                                </li>
                                <li class="breadcrumb-item active"> {{ isset($addon) ? 'Edit' : 'Add' }} AddOn
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s12">
            <div class="container">
                <form id="accountForm" action="{{ isset($addon) ? route('dashboard.addons.update', $addon) : route('dashboard.addons.store') }}" method="post">
                    @csrf
                    @if(isset($addon))
                        @method('PUT')
                    @endif
                    <div class="row mt-4">
                        <div class="col s12 m6">

                            <div class="row">
                                <div class="col s12 input-field">
                                    <i class="material-icons prefix">group</i>
                                    <select name="club">
                                        @foreach($clubs as $club)
                                            @if(isset($addon))
                                                <option value="{{$club->id}}" {{$addon->club->id == $club->id ? 'selected' : ''}}>{{$club->club_name}}</option>
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
                                    <input id="addon_code" name="addon_code" type="text" class="validate" value="{{ isset($addon) ? $addon->add_on_code : $code }}"
                                           data-error=".errorTxt2" readonly>
                                    <label for="addon_code">AddOn Code</label>
                                    <small class="errorTxt2" style="color: red">@error('addon_code') {{$message}} @enderror</small>
                                </div>
                                <div class="col s12 input-field">
                                    <i class="material-icons prefix">person_pin</i>
                                    <input id="addon_description" name="addon_description" type="text" class="validate" value="{{ isset($addon) ? $addon->add_on_description : old('addon_description') }}"
                                           data-error=".errorTxt3">
                                    <label for="addon_description">AddOn Description</label>
                                    <small class="errorTxt3" style="color: red">@error('addon_description') {{$message}} @enderror</small>
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

