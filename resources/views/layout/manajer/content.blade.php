<!DOCTYPE html>
<html>
<head>
  @include('include.meta')
  @if(Auth::user()->manajer)
  <title>Kokeru | Manajer</title>
  @else
  <title>Kokeru | CS</title>
  @endif
</head>
<body>
  <!-- Sidenav -->
  @include('include.sidenavman')
  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
    @include('include.topnav')
    <!-- Header -->
    @include('include.headercontent')
    <!-- Page content -->
    <div class="container-fluid mt--6">
      @yield('content')
      <!-- Footer -->
      <footer class="footer pt-0">
        @include('include.footerd')
      </footer>
    </div>
  </div>
  <!-- Argon Scripts -->
  <!-- Core -->
  @include('include.script')
</body>

</html>
