<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="dashboard-ecommerce.html">Admin</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="dashboard-ecommerce.html">SA</a>
        </div>
        <ul class="sidebar-menu">
            <li class="{{ Request::is('dashboard') ? 'active' : '' }}"><a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-home"></i> <span>Dashboard</span></a></li>
            <li class="{{ Request::is('dashboard/user') ? 'active' : '' }}"><a class="nav-link" href="{{ route('dashboard.user') }}"><i class="fas fa-user"></i> <span>User</span></a></li>
            <li class="{{ Request::is('dashboard/stock') ? 'active' : ''}}"><a class="nav-link" href="{{ route('dashboard.stock') }}"><i class="fas fa-box"></i> <span>Stock</span></a></li>
            <li class=""><a class="nav-link" href="{{ route('dashboard.user') }}"><i class="fas fa-receipt"></i> <span>Pembelian</span></a></li>
        </ul>
    </aside>
</div>
