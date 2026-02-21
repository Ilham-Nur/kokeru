<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
  <div class="scrollbar-inner">
    <!-- Brand -->
    <div class="sidenav-header align-items-center">
      <a class="navbar-brand" href="javascript:void(0)">
        <img src="{{asset('assets/img/brand/LogoUIS.png')}}" class="navbar-brand-img" alt="...">
        <br>
        <span class="mx-1 text-success">Universitas Ibnu Sina</span>
      </a>
    </div>
    <div class="navbar-inner">
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <ul class="navbar-nav">

          @if (auth()->user()->manajer == 1)
            {{-- Manajer Read Only DAN Manajer Full - menu sama, route sama --}}
            <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('manajer.dashboard') ? 'active' : '' }}"
                href="{{route('manajer.dashboard')}}">
                <i class="fas fa-home text-purple"></i>
                <span class="nav-link-text">Home</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('manajer.ruang.*') ? 'active' : '' }}"
                href="{{route('manajer.ruang.index')}}">
                <i class="ni ni-building text-orange"></i>
                <span class="nav-link-text">Ruang</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('manajer.cs.*') ? 'active' : '' }}"
                href="{{route('manajer.cs.index')}}">
                <i class="ni ni-single-02 text-primary"></i>
                <span class="nav-link-text">Cleaning Service</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('manajer.mitraac.*') ? 'active' : '' }}"
                href="{{route('manajer.mitraac.index')}}">
                <i class="ni ni-atom text-primary"></i>
                <span class="nav-link-text">Mitra AC</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('manajer.jadwal.*') ? 'active' : '' }}"
                href="{{route('manajer.jadwal.index')}}">
                <i class="ni ni-calendar-grid-58 text-yellow"></i>
                <span class="nav-link-text">Penugasan CS</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('manajer.laporan.*') ? 'active' : '' }}"
                href="{{route('manajer.laporan.index')}}">
                <i class="ni ni-collection text-info"></i>
                <span class="nav-link-text">Laporan</span>
              </a>
            </li>

          @elseif (auth()->user()->mitra == 1)
            <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('mitra.dashboard') ? 'active' : '' }}"
                href="{{ route('mitra.dashboard') }}">
                <i class="fas fa-home text-purple"></i>
                <span class="nav-link-text">Home</span>
              </a>
            </li>

          @else
            {{-- CS --}}
            <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('cs.dashboard') ? 'active' : '' }}"
                href="{{route('cs.dashboard')}}">
                <i class="fas fa-home text-purple"></i>
                <span class="nav-link-text">Home</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('cs.inventaris.*') ? 'active' : '' }}"
                href="{{route('cs.inventaris.index')}}">
                <i class="ni ni-building text-orange"></i>
                <span class="nav-link-text">Inventaris</span>
              </a>
            </li>
          @endif

        </ul>
      </div>
    </div>
  </div>
</nav>