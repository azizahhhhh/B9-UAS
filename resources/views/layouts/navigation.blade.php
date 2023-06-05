<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #6f4e37;">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon">
            <img src="{{asset('images/coconut2.png')}}" width="65" height="65" alt="">
        </div>
        <div class="sidebar-brand-text mx-3">GETCO</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item @if(request()->routeIs('home')) active @endif">
        <a class="nav-link " href="{{ route('home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>{{ __('Dashboard') }}</span>
        </a>
        <hr class="sidebar-divider">
    </li>

    <!-- Nav Item - Tables -->
    {{-- ADMIN --}}
    @role('Admin')
    <li class="nav-item @if(request()->routeIs('data-user')) active @endif">
        <a class="nav-link" href="{{ route('data-user') }}">
            <i class="fa-solid fa-users-line"></i>
            <span>{{ __('Data User') }}</span>
        </a>
    </li>
    <li class="nav-item @if(request()->routeIs('akun-premium')) active @endif">
        <a class="nav-link" href="{{ route('akun-premium') }}">
            <i class="fa-solid fa-crown"></i>
            <span>{{ __('Akun Premium') }}</span>
        </a>
    </li>
    @endrole

    {{-- PEMILIK USAHA --}}
    @role('Pemilik Usaha')
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
           aria-expanded="true" aria-controls="collapseTwo" style="padding-top: inherit;">
            <i class="fa-solid fa-store"></i>
            <span>Bahan Baku</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('pemilik-bahan-baku.index') }}">Bahan Baku Owner</a>
            </div>
        </div>
    </li>
    @if (Auth::user()->is_premium)
    <li class="nav-item @if(request()->routeIs('kerja-sama.index')) active @endif">
        <a class="nav-link" href="{{ route('kerja-sama.index') }}">
            <i class="fa-solid fa-handshake"></i>
            <span>{{ __('Kerjasama') }}</span>
        </a>
    </li>
    @endif
    @if (Auth::user()->is_premium)
    <li class="nav-item @if(request()->routeIs('kalkulator-produksi')) active @endif">
        <a class="nav-link" href="{{ route('kalkulator-produksi') }}">
            <i class="fa-solid fa-calculator"></i>
            <span>{{ __('Kalkulator Produksi') }}</span>
        </a>
    </li>
    @endif
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
           aria-expanded="true" aria-controls="collapseTwo" style="padding-top: inherit;">
           <i class="fa-solid fa-sack-dollar"></i>
            <span>Keuangan</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('pemilik-pemasukan.index') }}">Pemasukan</a>
                <a class="collapse-item" href="{{ route('pemilik-pengeluaran.index') }}">Pengeluaran</a>
                <a class="collapse-item" href="{{ route('laporan-keuangan-own') }}">Rekapitulasi Keuangan</a>
            </div>
        </div>
    </li>
    @endrole

    {{-- SUPPLIER --}}
    @role('Supplier')
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
           aria-expanded="true" aria-controls="collapseTwo" style="padding-top: inherit;">
            <i class="fa-solid fa-store"></i>
            <span>Bahan Baku</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('supplier-bahan-baku.index') }}">Bahan Baku Supplier</a>
            </div>
        </div>
    </li>
    <li class="nav-item @if(request()->routeIs('kerja-sama.index')) active @endif">
        <a class="nav-link" href="{{ route('kerja-sama.index') }}">
            <i class="fa-solid fa-handshake"></i>
            <span>{{ __('Kerjasama') }}</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
           aria-expanded="true" aria-controls="collapseTwo" style="padding-top: inherit;">
            <i class="fa-solid fa-sack-dollar"></i>
            <span>Keuangan</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('supplier-pemasukan.index') }}">Pemasukan</a>
                <a class="collapse-item" href="{{ route('laporan-keuangan-sup') }}">Rekapitulasi Keuangan</a>
            </div>
        </div>
    </li>
    @endrole

    @role(['Pemilik Usaha', 'Supplier'])
    <hr class="sidebar-divider">
    <li class="nav-item @if(request()->routeIs('syarat-akun-premium.index')) active @endif">
        <a class="nav-link" href="{{ route('syarat-akun-premium.index') }}">
            <i class="fa-solid fa-crown"></i>
            <span>{{ __('Syarat Akun Premium') }}</span>
        </a>
    </li>
    @endrole
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline pt-4">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
