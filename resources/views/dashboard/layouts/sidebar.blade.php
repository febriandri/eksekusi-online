<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="/dashboard">
                    <span data-feather="home"></span> Dashboard
                </a>
            </li>
            @cannot('admin') 
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>Eksekusi Putusan</span>
            </h6>   
            <li class="nav-item">
                <a class="nav-link {{ Request::is('permohonan*') ? 'active' : '' }}" href="/permohonan">
                    <span data-feather="layers"></span> Permohonan 
                </a>
            </li>
            @endcannot
        </ul>

        @can('admin')
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>EKSEKUSI</span>
        </h6>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/permohonan*') ? 'active' : '' }}" href="/admin/permohonan">
                    <span data-feather="layers"></span> Permohonan
                </a>
            </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>MASTER DATA</span>
        </h6>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/jenis/eksekusi*') ? 'active' : '' }}" href="/admin/jenis/eksekusi">
                    <span data-feather="book"></span> Jenis Eksekusi
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/kelengkapan*') ? 'active' : '' }}" href="/admin/kelengkapan">
                    <span data-feather="check-circle"></span> Kelengkapan
                </a>
            </li>
        </ul>
        @endcan
    </div>
</nav>