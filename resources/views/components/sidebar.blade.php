<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="dashboard-ecommerce.html">Admin</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="dashboard-ecommerce.html">SA</a>
        </div>
        <ul class="sidebar-menu">
            @if(auth()->user()->role == 'Admin')
            <li class="{{ Request::is('dashboard') ? 'active' : '' }}"><a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-home"></i> <span>Dashboard</span></a></li>
            <li class="{{ Request::is('dashboard/user') ? 'active' : '' }}"><a class="nav-link" href="{{ route('dashboard.user') }}"><i class="fas fa-user"></i> <span>User</span></a></li>
            <li class="nav-item dropdown {{ Request::is('dashboard/stock') ? 'active' : ''}}">
                <a href="{{ route('dashboard.stock') }}" class="nav-link has-dropdown"><i class="fas fa-boxes"></i><span>Stock</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('dashboard/stock') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('dashboard.stock') }}">◙ Stock Management</a>
                    </li>
                    <li class="{{ Request::is('dashboard/stock/history') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('dashboard.stock.history')}}">◙ Stock History</a>
                    </li>
                </ul>
            </li>
            @endif
            <li class="{{ Request::is('dashboard/pembelian') ? 'active' : ''}}"><a class="nav-link" href="{{ route('dashboard.pembelian') }}"><i class="fas fa-money-bill" style="color : green;"></i> <span>Pembelian</span></a></li>
        </ul>
    </aside>
</div>