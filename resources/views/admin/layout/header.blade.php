<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <p class="my-2">Welcome <strong>{{ Auth::guard('admin')->user()->name }} ({{ Auth::guard('admin')->user()->type }})</strong></p>
        </li>
    </ul>
</nav>
<!-- /.navbar -->