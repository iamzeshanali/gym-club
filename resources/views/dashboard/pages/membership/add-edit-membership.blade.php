@extends('dashboard.layouts.index')
@section('title', 'GymBook | Memberships')
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
                            <h5 class="breadcrumbs-title mt-0 mb-0 display-inline hide-on-small-and-down"><span>Memberships</span></h5>
                            <ol class="breadcrumbs mb-0">
                                <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('dashboard.memberships.index')}}">Memberships</a>
                                </li>
                                <li class="breadcrumb-item active"> {{ isset($membership) ? 'Edit' : 'Add' }} Membership
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s12">
            <div class="container">
                <form id="accountForm" action="{{ isset($membership) ? route('dashboard.memberships.update', $membership) : route('dashboard.memberships.store') }}" method="post">
                    @csrf
                    @if(isset($membership))
                        @method('PUT')
                    @endif
                    <div class="row mt-4">
                        <div class="col s12 m6">

                            <div class="row">
                                <div class="col s12 input-field">
                                    <i class="material-icons prefix">group</i>
                                    <select name="club">
                                        @foreach($clubs as $club)
                                            @if(isset($membership))
                                                <option value="{{$club->id}}" {{$membership->club->id == $club->id ? 'selected' : ''}}>{{$club->club_name}}</option>
                                            @else
                                                <option value="{{$club->id}}">{{$club->club_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <label>Club</label>
                                    <small class="errorTxt3" style="color: red">@error('club') {{$message}} @enderror</small>
                                </div>

                                <div class="col s12 input-field">
                                    <i class="material-icons prefix">group</i>
                                    <select name="subscription">
                                        @foreach($clubs as $club)
                                            @foreach($club->subscription as $subscription)
                                                <option value="{{$subscription->id}}">{{$subscription->subscription_description}}</option>
                                            @endforeach
                                        @endforeach
                                    </select>
                                    <label>Subscription</label>
                                    <small class="errorTxt3" style="color: red">@error('subscription') {{$message}} @enderror</small>
                                </div>

                                <div class="col s12 input-field">
                                    <i class="material-icons prefix">group</i>
                                    <select name="activity">
                                        @foreach($clubs as $club)
                                            @foreach($club->activity as $activity)
                                                <option value="{{$activity->id}}">{{$activity->activity_description}}</option>
                                            @endforeach
                                        @endforeach
                                    </select>
                                    <label>Activity</label>
                                    <small class="errorTxt3" style="color: red">@error('activity') {{$message}} @enderror</small>
                                </div>

                                <div class="col s12 input-field">
                                    <i class="material-icons prefix">person_pin</i>
                                    <input id="description" name="description" type="text" class="validate" value="{{ isset($membership) ? $membership->description : old('description') }}"
                                           data-error=".errorTxt2">
                                    <label for="description"> Description</label>
                                    <small class="errorTxt2" style="color: red">@error('description') {{$message}} @enderror</small>
                                </div>
                                <div class="col s12 input-field">
                                    <i class="material-icons prefix">person_pin</i>
                                    <input id="price" name="price" type="number" class="validate" value="{{ isset($membership) ? $membership->price : old('price') }}"
                                           data-error=".errorTxt3">
                                    <label for="price"> Price</label>
                                    <small class="errorTxt3" style="color: red">@error('price') {{$message}} @enderror</small>
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

