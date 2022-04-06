@extends('dashboard.layouts.index')
@section('title', 'GymBook | Roles')
@section('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/flag-icon/css/flag-icon.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/themes/vertical-modern-menu-template/materialize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/themes/vertical-modern-menu-template/style.css') }}">
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
                                <li class="breadcrumb-item"><a href="#">Users</a>
                                </li>
                                <li class="breadcrumb-item active"> {{ isset($user) ? 'Edit' : 'Add' }} User
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s12">
            <div class="container">
                <div class="row">
                    <div class="col s12">
                        <form id="accountForm" action="{{ isset($user) ? route('dashboard.users.update', $user) : route('dashboard.users.store') }}" method="post">
                            @csrf
                            @if(isset($user))
                                @method('PUT')
                            @endif
                            <div class="row">
                                <div class="col s12 m6">
                                    <div class="row">
                                        <div class="col s12 input-field">
                                            <i class="material-icons prefix">person_pin</i>
                                            <input id="name" name="name" type="text" class="validate" value="{{ old('name') }}"
                                                   data-error=".errorTxt2">
                                            <label for="name">Name</label>
                                            <small class="errorTxt2" style="color: red">@error('name') {{$message}} @enderror</small>
                                        </div>
                                        <div class="col s12 input-field">
                                            <i class="material-icons prefix">email</i>
                                            <input id="email" name="email" type="email" class="validate" value="{{ old('email') }}"
                                                   data-error=".errorTxt3">
                                            <label for="email">E-mail</label>
                                            <small class="errorTxt3" style="color: red">@error('email') {{$message}} @enderror</small>
                                        </div>
                                        <div class="col s12 input-field">
                                            <i class="material-icons prefix">phone</i>
                                            <input id="phone" name="phone" type="tel" class="validate" value="{{ old('phone') }}"
                                                   data-error=".errorTxt3">
                                            <label for="email">Phone</label>
                                            <small class="errorTxt3" style="color: red">@error('phone') {{$message}} @enderror</small>
                                        </div>
                                        <div class="col s12 input-field">
                                            <i class="material-icons prefix">mode_edit</i>
                                            <textarea id="comments" name="comments" class="materialize-textarea">{{ old('comments') }}</textarea>
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
                                                    <option value="{{$role->name}}">{{ ucfirst($role->name) }}</option>
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
                </div>
            </div>
            <div class="content-overlay"></div>
        </div>
    </div>
@endsection

@section('page-scripts')
    <script src="{{ asset('vendors/data-tables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('vendors/data-tables/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('vendors/data-tables/js/datatables.checkboxes.min.js') }}"></script>

    <script src="{{ asset('js/scripts/data-tables.js') }}"></script>

@endsection
