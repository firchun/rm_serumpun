<header class="pc-header bg-success ">
    <div class="container">
        <div class="header-wrapper">
            <div class="m-header">
                <a href="{{ url('/') }}" class="b-brand">
                    <!-- ========   change your logo hear   ============ -->
                    <img src="{{ asset('/img/logo-white.png') }}" alt="" class="logo logo-lg" height="50px">
                </a>
            </div>
            <div class="mr-auto pc-mob-drp">
                {{-- <ul class="list-unstyled">
                    <li class="dropdown pc-h-item">
                        <a class="pc-head-link active dropdown-toggle arrow-none mr-0" data-toggle="dropdown"
                            href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            Level
                        </a>
                        <div class="dropdown-menu pc-h-dropdown">
                            <a href="#!" class="dropdown-item">
                                <i data-feather="user"></i>
                                <span>My Account</span>
                            </a>
                            <div class="pc-level-menu">
                                <a href="#!" class="dropdown-item">
                                    <i data-feather="menu"></i>
                                    <span class="float-right"><i data-feather="chevron-right" class="mr-0"></i></span>
                                    <span>Level2.1</span>
                                </a>
                                <div class="dropdown-menu pc-h-dropdown">
                                    <a href="#!" class="dropdown-item">
                                        <i class="fas fa-circle"></i>
                                        <span>My Account</span>
                                    </a>
                                    <a href="#!" class="dropdown-item">
                                        <i class="fas fa-circle"></i>
                                        <span>Settings</span>
                                    </a>
                                    <a href="#!" class="dropdown-item">
                                        <i class="fas fa-circle"></i>
                                        <span>Support</span>
                                    </a>
                                    <a href="#!" class="dropdown-item">
                                        <i class="fas fa-circle"></i>
                                        <span>Lock Screen</span>
                                    </a>
                                    <a href="#!" class="dropdown-item">
                                        <i class="fas fa-circle"></i>
                                        <span>Logout</span>
                                    </a>
                                </div>
                            </div>
                            <a href="#!" class="dropdown-item">
                                <i data-feather="settings"></i>
                                <span>Settings</span>
                            </a>
                            <a href="#!" class="dropdown-item">
                                <i data-feather="life-buoy"></i>
                                <span>Support</span>
                            </a>
                            <a href="#!" class="dropdown-item">
                                <i data-feather="lock"></i>
                                <span>Lock Screen</span>
                            </a>
                            <a href="#!" class="dropdown-item">
                                <i data-feather="power"></i>
                                <span>Logout</span>
                            </a>
                        </div>
                    </li>

                </ul> --}}
            </div>
            <div class="ml-auto">
                <ul class="list-unstyled">
                    <li class="dropdown pc-h-item">
                        @guest
                            <a class="pc-head-link  arrow-none mr-0" href="{{ url('/login') }}">
                                <i data-feather="log-in"></i>&nbsp;Login
                            </a>
                        @else
                            <a class="pc-head-link  arrow-none mr-0" href="{{ url('/login') }}">
                                <i data-feather="airplay"></i>&nbsp;Dashboard
                            </a>
                        @endguest
                    </li>

                </ul>
            </div>

        </div>
    </div>
</header>
