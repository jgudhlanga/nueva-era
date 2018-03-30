<!-- Main Header -->
<header class="main-header">

    <!-- Logo -->
    <a href="index2.html" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>J</b>P</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">{{ config('app.name', 'J-PORTAL') }}</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- The user image in the navbar-->

                        @auth
                            <img src="{{ asset("storage/users/$profilePicture") }}" class="user-image">
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs">{{$userNames}}</span>
                        @endauth
                    </a>
                    <ul class="dropdown-menu">
                        <!-- The user image in the menu -->
                        <li class="user-header">
                            @auth
                                <img src="{{ asset("storage/users/$profilePicture") }}" class="img-circle">
                                <p>{{ $userNames }}</p>
                                <p>{{ $userRoles }}</p>
                            @endauth
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            @if (auth()->guest())
                                <div class="pull-left">
                                    <a href="{{ route('login') }}" class="btn btn-default btn-flat">
                                        @lang('general.login')
                                    </a>
                                </div>
                            @else
                                <div class="pull-left">
                                    <a href="{{ route('users.show', auth()->user()->id) }}" class="btn btn-default btn-flat">
                                        @choice('general.profile', 1)
                                    </a>
                                </div>
                                <div class="pull-right">
                                    <a class="btn btn-default btn-flat" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                        @lang('general.logout')
                                    </a>
                                </div>
                            @endif
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>