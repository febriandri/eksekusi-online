{{-- <nav class="navbar navbar-expand-lg navbar-dark bg-success">
  <div class="container">
    <a class="navbar-brand" href="/">Eksekusi Online</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="/">Beranda</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('/syarat') ? 'active' : '' }}" href="/posts">Syarat Permohoan Eksekusi</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('/kontak') ? 'active' : '' }}" href="/about">Kontak</a>
        </li>
      </ul>

      <ul class="navbar-nav ms-auto">
        @auth
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Welcome back, {{ auth()->user()->name }}
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="/dashboard"><i class="bi bi-layout-text-sidebar-reverse"></i> My Dashboard</a></li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <form action="/logout" method="POST">
                  @csrf
                  <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right"></i> Logout</button>
                </form>
              </li>
            </ul>
          </li>      
        @else
          <li class="nav-item">
            <a href="/login" class="nav-link {{ ($active === 'login') ? 'active' : '' }}"><i class="bi bi-box-arrow-in-right"></i> Login</a>
          </li>
        @endauth
      </ul>
    </div>
  </div>
</nav> --}}

<header class="p-3 mb-3 border-bottom">
  <div class="container">
    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
      <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
        {{-- <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg> --}}
        <img src="/img/eksekusi.png" alt="" class="bi me-2" height="32" role="img">
      </a>

      <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
        <li><a href="/" class="nav-link px-2 {{ Request::is('/') ? 'link-secondary' : 'link-dark' }}">Beranda</a></li>
        <li><a href="#" class="nav-link px-2 {{ Request::is('/syarat/permohonan/eksekusi') ? 'link-secondary' : 'link-dark' }}">Syarat Pemohonan Eksekusi</a></li>
        <li><a href="#" class="nav-link px-2 {{ Request::is('/kontak') ? 'link-secondary' : 'link-dark' }}">Kontak Kami</a></li>
      </ul>

      <ul class="nav mb-2 text-end">
        @auth
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle link-secondary" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Welcome back, {{ auth()->user()->name }}
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="/dashboard"><i class="bi bi-layout-text-sidebar-reverse"></i> My Dashboard</a></li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <form action="/logout" method="POST">
                  @csrf
                  <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right"></i> Logout</button>
                </form>
              </li>
            </ul>
          </li>      
        @else
          <li class="nav-item">
            <a href="/login" class="nav-link link-secondary {{ ($active === 'login') ? 'active' : '' }}"><i class="bi bi-box-arrow-in-right"></i> Login</a>
          </li>
        @endauth
      </ul>
    </div>
  </div>
</header>