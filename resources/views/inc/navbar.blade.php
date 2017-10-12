<nav id="top-nav-bar" class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
        </div>
        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                &nbsp;
            </ul>
            <ul class="nav navbar-nav">
                <li><a href="/dashboard">Dashboard</a></li>
                @if(Entrust::can('create'))
                    <li><a href="/posts/create">Create post</a></li>
                @endif
                <li><a href="/users">Users</a></li>
                <li><a href="/posts">Blog</a></li>
                @if(Entrust::hasRole('admin'))
                    <li><a href="/messages">PMs</a></li>
                @endif
                <li><a href="/about">About</a></li>
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @guest
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{--  Count the number of Notifications  --}}
                            <span class="glyphicon glyphicon-globe"></span>Notifications <span class="badge">{{ count(auth()->user()->unreadNotifications) }}</span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                {{--  For every notification for this user  --}}
                                @foreach(auth()->user()->unreadNotifications as $notification)                                     
                                    @include('layouts.partials.notifications.' . snake_case(class_basename($notification->type)))
                                @endforeach
                            </li>    
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="/userprofile/{{Auth::user()->id}}">Profile</a></li>
                            <li><a href="/dashboard">Dashboard</a></li>
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>