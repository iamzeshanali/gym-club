<header class="page-topbar" id="header">
    <div class="navbar navbar-fixed">
        <nav class="navbar-main navbar-color nav-collapsible sideNav-lock navbar-dark gradient-45deg-purple-deep-orange gradient-shadow">
            <div class="nav-wrapper">
                <div class="header-search-wrapper hide-on-med-and-down"><i class="material-icons">search</i>
                    <input class="header-search-input z-depth-2" type="text" name="Search" placeholder="Explore GymBook" data-search="template-list">
                    <ul class="search-list collection display-none"></ul>
                </div>
                <ul class="navbar-list right">
                    <li class="hide-on-med-and-down"><a class="waves-effect waves-block waves-light toggle-fullscreen" href="javascript:void(0);"><i class="material-icons">settings_overscan</i></a></li>
                    <li class="hide-on-large-only search-input-wrapper"><a class="waves-effect waves-block waves-light search-button" href="javascript:void(0);"><i class="material-icons">search</i></a></li>
                    <li><a class="waves-effect waves-block waves-light profile-button" href="javascript:void(0);" data-target="profile-dropdown"><span class="avatar-status avatar-online"><img src="{{ asset('images/avatar/avatar-7.png') }}" alt="avatar"><i></i></span></a></li>
                    <li><a class="waves-effect waves-block waves-light sidenav-trigger" href="#" data-target="slide-out-right"><i class="material-icons">format_indent_increase</i></a></li>
                </ul>

                <!-- profile-dropdown-->
                <ul class="dropdown-content" id="profile-dropdown">
                    <li><a class="grey-text text-darken-1" href="user-profile-page.html"><i class="material-icons">person_outline</i> {{\Illuminate\Support\Facades\Auth::user()->name}}</a></li>
                    <li><a class="grey-text text-darken-1" href="app-chat.html"><i class="material-icons">chat_bubble_outline</i> Chat</a></li>
                    <li><a class="grey-text text-darken-1" href="page-faq.html"><i class="material-icons">help_outline</i> Help</a></li>
                    <li class="divider"></li>
                    <li><a class="grey-text text-darken-1" href="user-lock-screen.html"><i class="material-icons">lock_outline</i> Lock</a></li>
                    <li><a class="grey-text text-darken-1" href="{{ route('user.logout') }}"><i class="material-icons">keyboard_tab</i> Logout</a></li>
                </ul>
            </div>
            <nav class="display-none search-sm">
                <div class="nav-wrapper">
                    <form id="navbarForm">
                        <div class="input-field search-input-sm">
                            <input class="search-box-sm mb-0" type="search" required="" id="search" placeholder="Explore Materialize" data-search="template-list">
                            <label class="label-icon" for="search"><i class="material-icons search-sm-icon">search</i></label><i class="material-icons search-sm-close">close</i>
                            <ul class="search-list collection search-list-sm display-none"></ul>
                        </div>
                    </form>
                </div>
            </nav>
        </nav>
    </div>
</header>
<!-- START RIGHT SIDEBAR NAV -->
<aside id="right-sidebar-nav">
    <div id="slide-out-right" class="slide-out-right-sidenav sidenav rightside-navigation">
        <div class="row">
            <div class="slide-out-right-title">
                <div class="col s12 border-bottom-1 pb-0 pt-1">
                    <div class="row">
                        <div class="col s2 pr-0 center">
                            <i class="material-icons vertical-text-middle"><a href="#" class="sidenav-close">clear</a></i>
                        </div>
                        <div class="col s10 pl-0">
                            <ul class="tabs">
                                <li class="tab col s6 p-0">
                                    <a href="#messages" class="active">
                                        <span>Clubs</span>
                                    </a>
                                </li>
                                <li class="tab col s6 p-0">
                                    <a href="#settings">
                                        <span>Settings</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="slide-out-right-body row pl-3">
                <div id="messages" class="col s12 pb-0">
                    @if(count(\Facades\App\Services\AuthUserClubsServices::currentUserClubs()) != 0)
                        @php
                            $club = \Facades\App\Services\AuthUserClubsServices::currentUserClubs();
                            if(count($club) > 0){
                                if(\Illuminate\Support\Facades\Session::exists('club_id')){

                                }else{
                                    \Illuminate\Support\Facades\Session::push('club_id',$club[0]->id);
                                }
                            }


                        @endphp
                    <div class="collection border-none mb-0">
                        <ul class="collection right-sidebar-chat p-0 mb-0">
                            @foreach(\Facades\App\Services\AuthUserClubsServices::currentUserClubs() as $club)
                                <li class="collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar pl-5 pb-0 {{ session('club_id')[0] == $club->id ? 'cyan' : '' }}" data-target="slide-out-chat" onclick="location.href='{{route('dashboard.changeClub', $club->id)}}'">
                                        <div class="user-content">
                                            <h6 class="line-height-0">
                                            </h6>
                                            <p class="medium-small blue-grey-text text-lighten-3 pt-3">{{$club->club_name}}</p>
                                        </div>
                                        <span class="secondary-content medium-small">
                                        <div class="chip {{ $club->type == 'gym' ? 'gradient-45deg-purple-deep-orange' : 'cyan' }} white-text">{{ucfirst($club->type)}}</div>
                                    </span>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                    @else
                        @php
                          \Illuminate\Support\Facades\Session::forget('club_id');
                        @endphp

                        <div class="collection border-none mb-0">
                            <p class="medium-small blue-grey-text text-lighten-3 pt-3">No Club Exist.</p>
                        </div>
                    @endif
                </div>
                <div id="settings" class="col s12">
                    <p class="setting-header mt-8 mb-3 ml-5 font-weight-900">GENERAL SETTINGS</p>
                    <ul class="collection border-none">
                        <li class="collection-item border-none">
                            <div class="m-0">
                                <span>Notifications</span>
                                <div class="switch right">
                                    <label>
                                        <input checked type="checkbox" />
                                        <span class="lever"></span>
                                    </label>
                                </div>
                            </div>
                        </li>
                        <li class="collection-item border-none">
                            <div class="m-0">
                                <span>Show recent activity</span>
                                <div class="switch right">
                                    <label>
                                        <input type="checkbox" />
                                        <span class="lever"></span>
                                    </label>
                                </div>
                            </div>
                        </li>
                        <li class="collection-item border-none">
                            <div class="m-0">
                                <span>Show recent activity</span>
                                <div class="switch right">
                                    <label>
                                        <input type="checkbox" />
                                        <span class="lever"></span>
                                    </label>
                                </div>
                            </div>
                        </li>
                        <li class="collection-item border-none">
                            <div class="m-0">
                                <span>Show Task statistics</span>
                                <div class="switch right">
                                    <label>
                                        <input type="checkbox" />
                                        <span class="lever"></span>
                                    </label>
                                </div>
                            </div>
                        </li>
                        <li class="collection-item border-none">
                            <div class="m-0">
                                <span>Show your emails</span>
                                <div class="switch right">
                                    <label>
                                        <input type="checkbox" />
                                        <span class="lever"></span>
                                    </label>
                                </div>
                            </div>
                        </li>
                        <li class="collection-item border-none">
                            <div class="m-0">
                                <span>Email Notifications</span>
                                <div class="switch right">
                                    <label>
                                        <input checked type="checkbox" />
                                        <span class="lever"></span>
                                    </label>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <p class="setting-header mt-7 mb-3 ml-5 font-weight-900">SYSTEM SETTINGS</p>
                    <ul class="collection border-none">
                        <li class="collection-item border-none">
                            <div class="m-0">
                                <span>System Logs</span>
                                <div class="switch right">
                                    <label>
                                        <input type="checkbox" />
                                        <span class="lever"></span>
                                    </label>
                                </div>
                            </div>
                        </li>
                        <li class="collection-item border-none">
                            <div class="m-0">
                                <span>Error Reporting</span>
                                <div class="switch right">
                                    <label>
                                        <input type="checkbox" />
                                        <span class="lever"></span>
                                    </label>
                                </div>
                            </div>
                        </li>
                        <li class="collection-item border-none">
                            <div class="m-0">
                                <span>Applications Logs</span>
                                <div class="switch right">
                                    <label>
                                        <input checked type="checkbox" />
                                        <span class="lever"></span>
                                    </label>
                                </div>
                            </div>
                        </li>
                        <li class="collection-item border-none">
                            <div class="m-0">
                                <span>Backup Servers</span>
                                <div class="switch right">
                                    <label>
                                        <input type="checkbox" />
                                        <span class="lever"></span>
                                    </label>
                                </div>
                            </div>
                        </li>
                        <li class="collection-item border-none">
                            <div class="m-0">
                                <span>Audit Logs</span>
                                <div class="switch right">
                                    <label>
                                        <input type="checkbox" />
                                        <span class="lever"></span>
                                    </label>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</aside>
<!-- END RIGHT SIDEBAR NAV -->
