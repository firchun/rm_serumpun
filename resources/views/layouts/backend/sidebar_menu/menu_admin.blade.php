<ul class="pc-navbar">
    <li class="pc-item pc-caption">
        <label>{{ env('APP_NAME') }}</label>
    </li>
    <li class="pc-item"><a href="{{ url('/') }}" class="pc-link "><span class="pc-micon"><i
                    data-feather="layout"></i></span><span class="pc-mtext">Dashboard</span></a></li>
    @if (Auth::user()->role == 'kasir')
        <li class="pc-item pc-caption">
            <label>Data</label>
        </li>
        <li class="pc-item"><a href="{{ url('/report/customers') }}" class="pc-link "><span class="pc-micon"><i
                        data-feather="users"></i></span><span class="pc-mtext">Pelanggan</span></a></li>
        <li class="pc-item"><a href="{{ url('/foods') }}" class="pc-link "><span class="pc-micon"><i
                        data-feather="layers"></i></span><span class="pc-mtext">Daftar Menu Makanan</span></a></li>
        <li class="pc-item pc-caption">
            <label>Transaksi</label>
        </li>
        <li class="pc-item"><a href="{{ url('/orders') }}" class="pc-link "><span class="pc-micon"><i
                        data-feather="shopping-cart"></i></span><span class="pc-mtext">Pesanan</span></a></li>
    @elseif(Auth::user()->role == 'pengelola')
        <li class="pc-item pc-caption">
            <label>Akun</label>
        </li>
        <li class="pc-item pc-hasmenu">
            <a href="javascript:void(0)" class="pc-link"><span class="pc-micon"><i data-feather="users"></i></span><span
                    class="pc-mtext">Modul User</span><span class="pc-arrow"><i
                        data-feather="chevron-right"></i></span></a>
            <ul class="pc-submenu">
                <li class="pc-item"><a href="{{ url('/user') }}" class="pc-link ">Akun Kasir</a></li>
            </ul>
            <ul class="pc-submenu">
                <li class="pc-item"><a href="{{ url('/user/member') }}" class="pc-link ">Akun User</a></li>
            </ul>
        </li>
    @elseif(Auth::user()->role == 'user')
        <li class="pc-item pc-caption">
            <label>Transaksi</label>
        </li>
        <li class="pc-item"><a href="{{ url('/orders/member') }}" class="pc-link "><span class="pc-micon"><i
                        data-feather="shopping-cart"></i></span><span class="pc-mtext">Pesanan</span></a></li>
    @endif
    @if (Auth::user()->role == 'pengelola')
        <li class="pc-item pc-caption">
            <label>laporan</label>
        </li>
        <li class="pc-item pc-hasmenu">
            <a href="javascript:void(0)" class="pc-link"><span class="pc-micon"><i
                        data-feather="folder"></i></span><span class="pc-mtext">Modul Laporan</span><span
                    class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
            <ul class="pc-submenu">
                <li class="pc-item"><a href="{{ url('/report/menu') }}" class="pc-link ">Laporan Menu</a></li>
            </ul>
            <ul class="pc-submenu">
                <li class="pc-item"><a href="{{ url('/report/orders') }}" class="pc-link ">Laporan Pesanan</a></li>
            </ul>
            <ul class="pc-submenu">
                <li class="pc-item"><a href="{{ url('/report/customers') }}" class="pc-link ">Laporan pelanggan</a>
                </li>
            </ul>
        </li>
    @endif

</ul>
