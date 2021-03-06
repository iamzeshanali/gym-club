<aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-light navbar-full sidenav-active-rounded">
    <div class="brand-sidebar">
        <h1 class="logo-wrapper"><a class="brand-logo darken-1" href="{{route('dashboard.index')}}"><img src="{{ asset('images/logo/materialize-logo.png') }}" alt="materialize logo" /><span class="logo-text hide-on-med-and-down">GymBook</span></a><a class="navbar-toggler" href="#"><i class="material-icons">radio_button_checked</i></a></h1>
    </div>
    <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out" data-menu="menu-navigation" data-collapsible="menu-accordion">
        <li class="active bold"><a class="waves-effect waves-cyan {{\Illuminate\Support\Facades\Request::route()->named('dashboard.index') ? 'active' : ''}}" href="{{ route('dashboard.index') }}"><i class="material-icons">settings_input_svideo</i><span class="menu-title" data-i18n="Dashboard">Dashboard</span></a>
        </li>


        <li class="navigation-header"><a class="navigation-header-text">Management</a><i class="navigation-header-icon material-icons">more_horiz</i>
        </li>
        <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)"><i class="material-icons">dvr</i><span class="menu-title" data-i18n="Club Management">Clubs Management</span></a>
            <div class="collapsible-body">
                <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                    <li class="bold"><a class="waves-effect waves-cyan {{\Illuminate\Support\Facades\Request::route()->named('dashboard.clubs.*') ? 'active' : ''}}" href="{{ route('dashboard.clubs.index') }}"><i class="material-icons">group_work</i><span class="menu-title" data-i18n="Clubs">Clubs</span></a>
                    </li>
                    <li class="bold"><a class="waves-effect waves-cyan {{\Illuminate\Support\Facades\Request::route()->named('dashboard.users.*') ? 'active' : ''}}" href="{{ route('dashboard.users.index') }}"><i class="material-icons">group</i><span class="menu-title" data-i18n="Users">Team</span></a>
                    </li>
                    <li class="bold"><a class="waves-effect waves-cyan {{\Illuminate\Support\Facades\Request::route()->named('dashboard.activities.*') ? 'active' : ''}}" href="{{ route('dashboard.activities.index') }}"><i class="material-icons">fitness_center</i><span class="menu-title" data-i18n="Activities">Activities</span></a>
                    </li>
                    <li class="bold"><a class="waves-effect waves-cyan {{\Illuminate\Support\Facades\Request::route()->named('dashboard.addons.*') ? 'active' : ''}}" href="{{ route('dashboard.addons.index') }}"><i class="material-icons">playlist_add</i><span class="menu-title" data-i18n="Add On Activity">Add On Activity</span></a>
                    </li>
                    <li class="bold"><a class="waves-effect waves-cyan {{\Illuminate\Support\Facades\Request::route()->named('dashboard.subscriptions.*') ? 'active' : ''}}" href="{{ route('dashboard.subscriptions.index') }}" disabled><i class="material-icons">book</i><span class="menu-title" data-i18n="Subscriptions">Subscriptions</span></a>
                    </li>
                    <li class="bold"><a class="waves-effect waves-cyan {{\Illuminate\Support\Facades\Request::route()->named('dashboard.memberships.*') ? 'active' : ''}}" href="{{ route('dashboard.memberships.index') }}"><i class="material-icons">people</i><span class="menu-title" data-i18n="Membership">Membership</span></a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="bold"><a class="waves-effect waves-cyan {{\Illuminate\Support\Facades\Request::route()->named('dashboard.roles.*') ? 'active' : ''}}" href="{{ route('dashboard.roles.index') }}"><i class="material-icons">lock</i><span class="menu-title" data-i18n="Roles">Roles</span></a>
        </li>
        <li class="bold"><a class="waves-effect waves-cyan {{\Illuminate\Support\Facades\Request::route()->named('dashboard.user-clubs-config.*') ? 'active' : ''}}" href="{{ route('dashboard.user-clubs-config.index') }}"><i class="material-icons">info_outline</i><span class="menu-title" data-i18n="Clubs">Users Config</span></a>
        </li>
        <li class="bold"><a class="waves-effect waves-cyan {{\Illuminate\Support\Facades\Request::route()->named('dashboard.members.*') ? 'active' : ''}}" href="{{ route('dashboard.members.index') }}"><i class="material-icons">assignment_ind</i><span class="menu-title" data-i18n="Members">Members</span></a>
        </li>
        <li class="bold"><a class="waves-effect waves-cyan {{\Illuminate\Support\Facades\Request::route()->named('dashboard.inquiries.*') ? 'active' : ''}}" href="{{ route('dashboard.inquiries.index') }}"><i class="material-icons">info_outline</i><span class="menu-title" data-i18n="Inquiries">Inquiries</span></a>
        </li>
        <li class="bold"><a class="waves-effect waves-cyan {{\Illuminate\Support\Facades\Request::route()->named('dashboard.timelogs.*') ? 'active' : ''}}" href="{{ route('dashboard.timelogs.index') }}"><i class="material-icons">date_range</i><span class="menu-title" data-i18n="Time log">Time Log</span></a>
        </li>
        <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)"><i class="material-icons">trending_up</i><span class="menu-title" data-i18n="Accounting">Accounting</span></a>
            <div class="collapsible-body">
                <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                    <li><a class="waves-effect waves-cyan" href="JavaScript:void(0)"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Vertical">Collection</span></a>
                    </li>
                    <li><a class="waves-effect waves-cyan" href="JavaScript:void(0)"><i class="material-icons">people</i><span data-i18n="Horizontal">Invoice</span></a>
                    </li>
                    <li><a class="waves-effect waves-cyan" href="JavaScript:void(0)"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Horizontal">Receipts</span></a>
                    </li>
                    <li><a class="waves-effect waves-cyan" href="JavaScript:void(0)"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Horizontal">Expenses</span></a>
                    </li>
                    <li><a class="waves-effect waves-cyan" href="JavaScript:void(0)"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Horizontal">COA</span></a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)"><i class="material-icons">pie_chart_outlined</i><span class="menu-title" data-i18n="Reports">Reports</span></a>
            <div class="collapsible-body">
                <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                    <li><a class="waves-effect waves-cyan" href="JavaScript:void(0)"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Monthy Report">Monthy Report</span></a>
                    </li>
                    <li><a class="waves-effect waves-cyan" href="JavaScript:void(0)"><i class="material-icons">people</i><span data-i18n="Annual Report">Annual Report</span></a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="bold"><a class="waves-effect waves-cyan " href="https://pixinvent.ticksy.com/" target="_blank"><i class="material-icons">help_outline</i><span class="menu-title" data-i18n="Support">Knowledge Base</span></a>
        </li>
    </ul>
    <div class="navigation-background"></div><a class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only" href="#" data-target="slide-out"><i class="material-icons">menu</i></a>
</aside>
