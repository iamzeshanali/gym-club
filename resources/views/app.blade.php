<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google.">
    <meta name="keywords" content="materialize, admin template, dashboard template, flat admin template, responsive admin template, eCommerce dashboard, analytic dashboard">
    <meta name="author" content="ThemeSelect">
    <title>@yield('title')</title>

    <link rel="apple-touch-icon" href="{{ asset('images/favicon/apple-touch-icon-152x152.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon/favicon-32x32.png') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- BEGIN: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/animate-css/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/sweetalert/sweetalert.css') }}">
    <!-- END: VENDOR CSS-->
    <!-- BEGIN: Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/themes/vertical-menu-nav-dark-template/materialize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/themes/vertical-menu-nav-dark-template/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/pages/dashboard-modern.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/pages/intro.css') }}">

    <!-- END: Page Level CSS-->
    @yield('page-css')
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/custom/custom.css') }}">
    <!-- END: Custom CSS-->
</head>
<!-- END: Head-->

<body class="vertical-layout page-header-light vertical-menu-collapsible vertical-menu-nav-dark preload-transitions 2-columns" data-open="click" data-menu="vertical-menu-nav-dark" data-col="2-columns">



<!-- BEGIN: Page Main-->
@yield('page')
<!-- END: Page Main-->
<!-- Theme Customizer -->

<a
    href="#"
    data-target="theme-cutomizer-out"
    class="btn btn-customizer pink accent-2 white-text sidenav-trigger theme-cutomizer-trigger"
><i class="material-icons">settings</i></a
>
<div id="theme-cutomizer-out" class="theme-cutomizer sidenav row">
    <div class="col s12">
        <a class="sidenav-close" href="#!"><i class="material-icons">close</i></a>
        <h5 class="theme-cutomizer-title">Theme Customizer</h5>
        <p class="medium-small">Customize & Preview in Real Time</p>
        <div class="menu-options">
            <h6 class="mt-6">Menu Options</h6>
            <hr class="customize-devider" />
            <div class="menu-options-form row">
                <div class="input-field col s12 menu-color mb-0">
                    <p class="mt-0">Menu Color</p>
                    <div class="gradient-color center-align">
                        <span class="menu-color-option gradient-45deg-indigo-blue" data-color="gradient-45deg-indigo-blue"></span>
                        <span
                            class="menu-color-option gradient-45deg-purple-deep-orange"
                            data-color="gradient-45deg-purple-deep-orange"
                        ></span>
                        <span
                            class="menu-color-option gradient-45deg-light-blue-cyan"
                            data-color="gradient-45deg-light-blue-cyan"
                        ></span>
                        <span
                            class="menu-color-option gradient-45deg-purple-amber"
                            data-color="gradient-45deg-purple-amber"
                        ></span>
                        <span
                            class="menu-color-option gradient-45deg-purple-deep-purple"
                            data-color="gradient-45deg-purple-deep-purple"
                        ></span>
                        <span
                            class="menu-color-option gradient-45deg-deep-orange-orange"
                            data-color="gradient-45deg-deep-orange-orange"
                        ></span>
                        <span class="menu-color-option gradient-45deg-green-teal" data-color="gradient-45deg-green-teal"></span>
                        <span
                            class="menu-color-option gradient-45deg-indigo-light-blue"
                            data-color="gradient-45deg-indigo-light-blue"
                        ></span>
                        <span class="menu-color-option gradient-45deg-red-pink" data-color="gradient-45deg-red-pink"></span>
                    </div>
                    <div class="solid-color center-align">
                        <span class="menu-color-option red" data-color="red"></span>
                        <span class="menu-color-option purple" data-color="purple"></span>
                        <span class="menu-color-option pink" data-color="pink"></span>
                        <span class="menu-color-option deep-purple" data-color="deep-purple"></span>
                        <span class="menu-color-option cyan" data-color="cyan"></span>
                        <span class="menu-color-option teal" data-color="teal"></span>
                        <span class="menu-color-option light-blue" data-color="light-blue"></span>
                        <span class="menu-color-option amber darken-3" data-color="amber darken-3"></span>
                        <span class="menu-color-option brown darken-2" data-color="brown darken-2"></span>
                    </div>
                </div>
                <div class="input-field col s12 menu-bg-color mb-0">
                    <p class="mt-0">Menu Background Color</p>
                    <div class="gradient-color center-align">
                  <span
                      class="menu-bg-color-option gradient-45deg-indigo-blue"
                      data-color="gradient-45deg-indigo-blue"
                  ></span>
                        <span
                            class="menu-bg-color-option gradient-45deg-purple-deep-orange"
                            data-color="gradient-45deg-purple-deep-orange"
                        ></span>
                        <span
                            class="menu-bg-color-option gradient-45deg-light-blue-cyan"
                            data-color="gradient-45deg-light-blue-cyan"
                        ></span>
                        <span
                            class="menu-bg-color-option gradient-45deg-purple-amber"
                            data-color="gradient-45deg-purple-amber"
                        ></span>
                        <span
                            class="menu-bg-color-option gradient-45deg-purple-deep-purple"
                            data-color="gradient-45deg-purple-deep-purple"
                        ></span>
                        <span
                            class="menu-bg-color-option gradient-45deg-deep-orange-orange"
                            data-color="gradient-45deg-deep-orange-orange"
                        ></span>
                        <span class="menu-bg-color-option gradient-45deg-green-teal" data-color="gradient-45deg-green-teal"></span>
                        <span
                            class="menu-bg-color-option gradient-45deg-indigo-light-blue"
                            data-color="gradient-45deg-indigo-light-blue"
                        ></span>
                        <span class="menu-bg-color-option gradient-45deg-red-pink" data-color="gradient-45deg-red-pink"></span>
                    </div>
                    <div class="solid-color center-align">
                        <span class="menu-bg-color-option red" data-color="red"></span>
                        <span class="menu-bg-color-option purple" data-color="purple"></span>
                        <span class="menu-bg-color-option pink" data-color="pink"></span>
                        <span class="menu-bg-color-option deep-purple" data-color="deep-purple"></span>
                        <span class="menu-bg-color-option cyan" data-color="cyan"></span>
                        <span class="menu-bg-color-option teal" data-color="teal"></span>
                        <span class="menu-bg-color-option light-blue" data-color="light-blue"></span>
                        <span class="menu-bg-color-option amber darken-3" data-color="amber darken-3"></span>
                        <span class="menu-bg-color-option brown darken-2" data-color="brown darken-2"></span>
                    </div>
                </div>
                <div class="input-field col s12">
                    <div class="switch">
                        Menu Dark
                        <label class="float-right"
                        ><input class="menu-dark-checkbox" type="checkbox"/> <span class="lever ml-0"></span
                            ></label>
                    </div>
                </div>
                <div class="input-field col s12">
                    <div class="switch">
                        Menu Collapsed
                        <label class="float-right"
                        ><input class="menu-collapsed-checkbox" type="checkbox"/> <span class="lever ml-0"></span
                            ></label>
                    </div>
                </div>
                <div class="input-field col s12">
                    <div class="switch">
                        <p class="mt-0">Menu Selection</p>
                        <label>
                            <input
                                class="menu-selection-radio with-gap"
                                value="sidenav-active-square"
                                name="menu-selection"
                                type="radio"
                            />
                            <span>Square</span>
                        </label>
                        <label>
                            <input
                                class="menu-selection-radio with-gap"
                                value="sidenav-active-rounded"
                                name="menu-selection"
                                type="radio"
                            />
                            <span>Rounded</span>
                        </label>
                        <label>
                            <input class="menu-selection-radio with-gap" value="" name="menu-selection" type="radio" />
                            <span>Normal</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <h6 class="mt-6">Navbar Options</h6>
        <hr class="customize-devider" />
        <div class="navbar-options row">
            <div class="input-field col s12 navbar-color mb-0">
                <p class="mt-0">Navbar Color</p>
                <div class="gradient-color center-align">
                    <span class="navbar-color-option gradient-45deg-indigo-blue" data-color="gradient-45deg-indigo-blue"></span>
                    <span
                        class="navbar-color-option gradient-45deg-purple-deep-orange"
                        data-color="gradient-45deg-purple-deep-orange"
                    ></span>
                    <span
                        class="navbar-color-option gradient-45deg-light-blue-cyan"
                        data-color="gradient-45deg-light-blue-cyan"
                    ></span>
                    <span class="navbar-color-option gradient-45deg-purple-amber" data-color="gradient-45deg-purple-amber"></span>
                    <span
                        class="navbar-color-option gradient-45deg-purple-deep-purple"
                        data-color="gradient-45deg-purple-deep-purple"
                    ></span>
                    <span
                        class="navbar-color-option gradient-45deg-deep-orange-orange"
                        data-color="gradient-45deg-deep-orange-orange"
                    ></span>
                    <span class="navbar-color-option gradient-45deg-green-teal" data-color="gradient-45deg-green-teal"></span>
                    <span
                        class="navbar-color-option gradient-45deg-indigo-light-blue"
                        data-color="gradient-45deg-indigo-light-blue"
                    ></span>
                    <span class="navbar-color-option gradient-45deg-red-pink" data-color="gradient-45deg-red-pink"></span>
                </div>
                <div class="solid-color center-align">
                    <span class="navbar-color-option red" data-color="red"></span>
                    <span class="navbar-color-option purple" data-color="purple"></span>
                    <span class="navbar-color-option pink" data-color="pink"></span>
                    <span class="navbar-color-option deep-purple" data-color="deep-purple"></span>
                    <span class="navbar-color-option cyan" data-color="cyan"></span>
                    <span class="navbar-color-option teal" data-color="teal"></span>
                    <span class="navbar-color-option light-blue" data-color="light-blue"></span>
                    <span class="navbar-color-option amber darken-3" data-color="amber darken-3"></span>
                    <span class="navbar-color-option brown darken-2" data-color="brown darken-2"></span>
                </div>
            </div>
            <div class="input-field col s12">
                <div class="switch">
                    Navbar Dark
                    <label class="float-right"
                    ><input class="navbar-dark-checkbox" type="checkbox"/> <span class="lever ml-0"></span
                        ></label>
                </div>
            </div>
            <div class="input-field col s12">
                <div class="switch">
                    Navbar Fixed
                    <label class="float-right"
                    ><input class="navbar-fixed-checkbox" type="checkbox" checked/> <span class="lever ml-0"></span
                        ></label>
                </div>
            </div>
        </div>
        <h6 class="mt-6">Footer Options</h6>
        <hr class="customize-devider" />
        <div class="navbar-options row">
            <div class="input-field col s12">
                <div class="switch">
                    Footer Dark
                    <label class="float-right"
                    ><input class="footer-dark-checkbox" type="checkbox"/> <span class="lever ml-0"></span
                        ></label>
                </div>
            </div>
            <div class="input-field col s12">
                <div class="switch">
                    Footer Fixed
                    <label class="float-right"
                    ><input class="footer-fixed-checkbox" type="checkbox"/> <span class="lever ml-0"></span
                        ></label>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ Theme Customizer -->
<!-- EMBED: Jquery-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- BEGIN VENDOR JS-->
<script src="{{ asset('js/vendors.min.js') }}"></script>
<!-- BEGIN VENDOR JS-->
<!-- BEGIN PAGE VENDOR JS-->


<!-- END PAGE VENDOR JS-->
<!-- BEGIN THEME  JS-->
<script src="{{ asset('js/plugins.js') }}"></script>
<script src="{{ asset('js/search.js') }}"></script>
<script src="{{ asset('js/custom/custom-script.js') }}"></script>
<script src="{{ asset('js/scripts/customizer.js') }}"></script>

<!-- END THEME  JS-->
<!-- BEGIN PAGE LEVEL JS-->
<script src="{{ asset('js/scripts/dashboard-modern.js') }}"></script>
<script src="{{ asset('js/scripts/intro.js') }}"></script>

<!-- END PAGE LEVEL JS-->

{{-- Page Scripts--}}
@yield('page-scripts')
</body>

</html>
