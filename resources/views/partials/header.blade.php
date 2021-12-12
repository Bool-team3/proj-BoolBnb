<div class="wrapper header_user">
    <!-- Sidebar  -->
    <nav id="navbar_header">
        <div>
            <a href="{{ route('home') }}">
                <figure id="logo-header" class="d-none d-md-block d-lg-block d-xl-block">
                    <img src="{{ asset('storage/public/logo/logo_small.png') }}" 
                    alt="Logo b&b" title="Torna alla Home">
                </figure>
                <figure id="logo-header" class="d-md-none d-lg-none">
                    <img src="{{ asset('storage/public/logo/logo_small_icon_only.png') }}" 
                    alt="Logo b&b" title="Torna alla Home">
                </figure>
            </a>
        </div>
        <ul>
            @foreach($header_link as $link)
                <li class="{{request()->routeIs($link['route']) ? 'active' : ''}}">
                    <a href="{{ route($link["route"]) }}" title="{{ $link["text"] }}">{{ $link["text"] }}</a>
                    <div class="line-decoration"></div>
                </li>
            @endforeach
        </ul>

        <div id="logout-navbar">
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                </a>
    
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a id="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
    
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        </div>
    </nav>
</div>