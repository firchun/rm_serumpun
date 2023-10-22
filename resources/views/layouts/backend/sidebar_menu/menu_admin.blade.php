<ul class="pc-navbar">
    <li class="pc-item pc-caption">
        <label>{{ env('APP_NAME') }}</label>
    </li>
    <li class="pc-item"><a href="{{ url('/') }}" class="pc-link "><span class="pc-micon"><i
                    data-feather="layout"></i></span><span class="pc-mtext">Dashboard</span></a></li>
    <li class="pc-item pc-caption">
        <label>Data</label>
    </li>
    <li class="pc-item"><a href="{{ url('/foods') }}" class="pc-link "><span class="pc-micon"><i
                    data-feather="layout"></i></span><span class="pc-mtext">Daftar Menu</span></a></li>
    <li class="pc-item pc-caption">
        <label>Transaksi</label>
    </li>
    <li class="pc-item"><a href="{{ url('/orders') }}" class="pc-link "><span class="pc-micon"><i
                    data-feather="layout"></i></span><span class="pc-mtext">Pesanan</span></a></li>
    @if (Auth::user()->role == 'admin')
        <li class="pc-item pc-caption">
            <label>Akun</label>
        </li>
        <li class="pc-item pc-hasmenu">
            <a href="javascript:void(0)" class="pc-link"><span class="pc-micon"><i data-feather="users"></i></span><span
                    class="pc-mtext">Modul User</span><span class="pc-arrow"><i
                        data-feather="chevron-right"></i></span></a>
            <ul class="pc-submenu">
                <li class="pc-item"><a href="{{ url('/user') }}" class="pc-link ">Akun Admin</a></li>
            </ul>
        </li>
    @endif

</ul>
