@extends('app')
@section('title', 'GymBook | Register')
@section('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/pages/register.css') }}">
@endsection
@section('page')
    <div class="row">
        <div class="col s12">
            <div class="container">
                <div id="register-page" class="row">
                    <div class="col s12 m6 l4 z-depth-4 card-panel border-radius-6 register-card bg-opacity-8">
                        @error('roles-error')
                            <div class="card-alert card gradient-45deg-red-pink" id="error-alert">
                                <div class="card-content white-text">
                                    <p>
                                        <i class="material-icons">error</i> Failed : No Role Created Yet.</p>
                                </div>
                                <button type="button" onclick="document.getElementById('error-alert').style.display='none';return false;" class="close white-text" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        @enderror
                        <form id="register-form" class="login-form" action="{{ route('user.register') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="input-field col s12">
                                    <h5 class="ml-4">Register</h5>
                                    <p class="ml-4">Join to our community now !</p>
                                </div>
                            </div>
                            <div class="row margin">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix pt-2">person_outline</i>
                                    <input name="name" id="name" type="text" value="{{ old('name') }}" required>
                                    <label for="name" class="center-align">Username</label>
                                    <span style="color: red">@error('name') {{$message}} @enderror</span>
                                </div>
                            </div>
                            <div class="row margin">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix pt-2">mail_outline</i>
                                    <input name="email" id="email" type="email" value="{{ old('email') }}" required>
                                    <label for="email">Email</label>
                                    <span style="color: red">@error('email') {{$message}} @enderror</span>
                                </div>
                            </div>
                            <div class="row margin">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix pt-2">lock_outline</i>
                                    <input name="password" id="password" type="password" value="{{ old('password') }}" required>
                                    <label for="password">Password</label>
                                    <span style="color: red">@error('password') {{$message}} @enderror</span>
                                </div>
                            </div>
                            <div class="row margin">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix pt-2">lock_outline</i>
                                    <input name="password_confirmation" id="password_confirmation" type="password" value="{{ old('password-again') }}" required>
                                    <label for="password_confirmation">Password again</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <a class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12" onclick="submit()"  type="submit">Register</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <p class="margin medium-small"><a href="{{ route('login') }}">Already have an account? Login</a></p>
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
        $('#register-form').submit();
    }
</script>

