<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        {{-- <img src="{{ asset('img/logo.jpg') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
        style="opacity: .8; width: 50px; height: 50px"> --}}
        <span class="brand-text font-weight-light ml-2">PORTAL COMMERCE</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ auth()->user()->avatar ? asset(auth()->user()->avatar) : 'https://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?f=y' }}"
                    class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name }} {{ auth()->user()->lastname }}</a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @can('admin.cash.dashboard')
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @endcan
                @can('admin.category')
                <li class="nav-item">
                    <a href="{{ route('category.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-sitemap"></i>
                        <p>
                            Categoría
                        </p>
                    </a>
                </li>
                @endcan
                @can(['admin.product', 'admin.product.photo'])
                <li class="nav-item">
                    <a href="{{ route('product.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-warehouse"></i>
                        <p>
                            Productos
                        </p>
                    </a>
                </li>
                @endcan
                @can('admin.user')
                <li class="nav-item">
                    <a href="{{ route('user.index') }}" class="nav-link">
                        <i class="nav-icon far fa-user"></i>
                        <p>
                            Usuarios
                        </p>
                    </a>
                </li>
                @endcan
                @can('admin.coupon')
                <li class="nav-item">
                    <a href="{{ route('coupon.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-tags"></i>
                        <p>
                            Cupón
                        </p>
                    </a>
                </li>
                @endcan
                @can('admin.order')
                <li class="nav-item">
                    <a href="{{ route('order.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-file-invoice"></i>
                        <p>
                            Ventas
                        </p>
                    </a>
                </li>
                @endcan
                @can('admin.buy_order')
                <li class="nav-item">
                    <a href="{{ route('buy-order.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>
                            Ordenes de compra
                        </p>
                    </a>
                </li>
                @endcan
                @can('admin.cash.register')
                <li class="nav-item">
                    <a href="{{ route('cash.register') }}" class="nav-link">
                        <i class="nav-icon fas fa-cash-register"></i>
                        <p>
                            Caja registradora
                        </p>
                    </a>
                </li>
                @endcan
                @can('admin.provider')
                <li class="nav-item">
                    <a href="{{ route('provider.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            Proveedor
                        </p>
                    </a>
                </li>
                @endcan
                @can('admin.settings')
                <li class="nav-item">
                    <a href="{{ route('settings') }}" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Configuración
                        </p>
                    </a>
                </li>
                @endcan
                @can('admin.settings')
                <li class="nav-item">
                    <a href="{{ route('audit.index') }}" class="nav-link">
                        <i class="nav-icon fa fa-history"></i>
                        <p>
                            Auditoría
                        </p>
                    </a>
                </li>
                @endcan
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>