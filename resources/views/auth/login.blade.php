@extends('app')
@section('title', 'GymBook | Login')
@section('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/pages/login.css') }}">
@endsection
@section('page')
<div class="row">
    <div class="col s12">
        <div class="container">
            <div id="login-page" class="row">
                <div class="col s12 m6 l4 z-depth-4 card-panel border-radius-6 login-card bg-opacity-8">
                    @error('login-failed')
                    <div class="card-alert card gradient-45deg-red-pink" id="error-alert">
                        <div class="card-content white-text">
                            <p>
                                <i class="material-icons">error</i> Failed : Email or Password Incorrect.</p>
                        </div>
                        <button type="button" onclick="document.getElementById('error-alert').style.display='none';return false;" class="close white-text" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    @enderror
                    <form id="login-form" class="login-form" action="{{ route('user.login') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="input-field col s12">
                                <h5 class="ml-4">Sign in</h5>
                            </div>
                        </div>
                        <div class="row margin">
                            <div class="input-field col s12">
                                <i class="material-icons prefix pt-2">person_outline</i>
                                <input name="email" id="email" type="text" value="{{ old('email') }}">
                                <label for="email" class="center-align">Email</label>
                                <span style="color: red">@error('email') {{$message}} @enderror</span>
                            </div>
                        </div>
                        <div class="row margin">
                            <div class="input-field col s12">
                                <i class="material-icons prefix pt-2">lock_outline</i>
                                <input name="password" id="password" type="password" value="{{ old('password') }}">
                                <label for="password">Password</label>
                                <span style="color: red">@error('password') {{$message}} @enderror</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 m12 l12 ml-2 mt-1">
                                <p>
                                    <label>
                                        <input name="reme" type="checkbox" />
                                        <span>Remember Me</span>
                                    </label>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <a onclick="submit()" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">Login</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6 m6 l6">
                                <p class="margin medium-small"><a href="{{ route('register') }}">Register Now!</a></p>
                            </div>
                            <div class="input-field col s6 m6 l6">
                                <p class="margin right-align medium-small"><a href="{{ route('forgot-password') }}">Forgot password ?</a></p>
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
<script>
    function submit(){
        $('#login-form').submit();
    }
</script>

