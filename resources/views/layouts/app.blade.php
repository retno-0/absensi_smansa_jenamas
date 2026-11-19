<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Absensi SMAN 1 Jenamas')</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="dash-body">

<div class="dash-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

<div class="dash-layout" id="dashLayout">

    <aside class="dash-sidebar" id="sidebar">

        {{-- LOGO --}}
        <div class="dash-brand">
            <div class="dash-logo">S</div>

            <div class="dash-brand-text">
                <strong>ABSENSI</strong>
                <small>SMAN 1 JENAMAS</small>
            </div>
        </div>

        {{-- MENU SISWA --}}
        @if(Auth::user()->role === 'siswa')

            <div class="dash-menu-label">MENU SISWA</div>

            <nav class="dash-menu">

                <a href="{{ route('siswa.dashboard') }}"
                   class="dash-menu-item {{ request()->routeIs('siswa.dashboard') ? 'active' : '' }}">
                    <span class="dash-icon">⌂</span>
                    <span class="dash-menu-text">Beranda</span>
                </a>

                <a href="{{ route('siswa.absensi') }}"
                class="dash-menu-item {{ request()->routeIs('siswa.absensi*') ? 'active' : '' }}">
                    <span class="dash-icon">◉</span>
                    <span class="dash-menu-text">Absensi</span>
                </a>

                <a href="{{ route('siswa.riwayat') }}"
                class="dash-menu-item {{ request()->routeIs('siswa.riwayat*') ? 'active' : '' }}">
                    <span class="dash-icon">◷</span>
                    <span class="dash-menu-text">Riwayat Absensi</span>
                </a>

            </nav>

        {{-- MENU GURU --}}
        @elseif(Auth::user()->role === 'guru')

            <div class="dash-menu-label">MENU GURU</div>

            <nav class="dash-menu">

                <a href="{{ route('guru.absensi') }}"
                   class="dash-menu-item {{ request()->routeIs('guru.absensi') ? 'active' : '' }}">
                    <span class="dash-icon">⌂</span>
                    <span class="dash-menu-text">Dashboard Guru</span>
                </a>

                <a href="{{ route('absensi.index') }}"
                   class="dash-menu-item {{ request()->routeIs('absensi.*') ? 'active' : '' }}">
                    <span class="dash-icon">◷</span>
                    <span class="dash-menu-text">Kelola Absensi</span>
                </a>

                <a href="{{ route('laporan.index') }}"
                   class="dash-menu-item">
                    <span class="dash-icon">▧</span>
                    <span class="dash-menu-text">Laporan</span>
                </a>

            </nav>

        {{-- MENU ADMIN --}}
        @else

            <div class="dash-menu-label">MENU UTAMA</div>

            <nav class="dash-menu">

                <a href="{{ route('dashboard') }}"
                   class="dash-menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <span class="dash-icon">▦</span>
                    <span class="dash-menu-text">Dashboard</span>
                </a>

                <a href="{{ route('siswa.index') }}"
                   class="dash-menu-item {{ request()->routeIs('siswa.index') ? 'active' : '' }}">
                    <span class="dash-icon">♙</span>
                    <span class="dash-menu-text">Data Siswa</span>
                </a>

                <a href="{{ route('guru.index') }}"
                   class="dash-menu-item {{ request()->routeIs('guru.index') ? 'active' : '' }}">
                    <span class="dash-icon">♧</span>
                    <span class="dash-menu-text">Data Guru</span>
                </a>

                <a href="{{ route('kelas.index') }}"
                   class="dash-menu-item {{ request()->routeIs('kelas.index') ? 'active' : '' }}">
                    <span class="dash-icon">▤</span>
                    <span class="dash-menu-text">Data Kelas</span>
                </a>

                <div class="dash-menu-label">KEGIATAN</div>

                <a href="{{ route('laporan.index') }}"
                   class="dash-menu-item {{ request()->routeIs('laporan.*') ? 'active' : '' }}">
                    <span class="dash-icon">▧</span>
                    <span class="dash-menu-text">Laporan</span>
                </a>

            </nav>

        @endif

        {{-- INFORMASI PENGGUNA DAN LOGOUT --}}
        <div class="dash-sidebar-bottom">

            <div class="dash-user-mini">

                <div class="dash-avatar">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>

                <div class="dash-user-info">
                    <strong>{{ Auth::user()->name }}</strong>
                    <small>{{ ucfirst(Auth::user()->role) }}</small>
                </div>

            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button type="submit" class="dash-logout">
                    <span class="dash-icon">⇥</span>
                    <span class="dash-menu-text">Keluar</span>
                </button>
            </form>

        </div>

    </aside>

    {{-- KONTEN UTAMA --}}
    <main class="dash-main">

        <header class="dash-topbar">

            <div class="dash-topbar-left">

                <button type="button"
                        class="dash-toggle"
                        onclick="toggleSidebar()"
                        aria-label="Toggle sidebar">
                    ☰
                </button>

                <div>
                    <h2>
                        @yield('page-heading', 'Dashboard')
                    </h2>

                    <p>
                        @yield('page-description', 'Sistem informasi absensi sekolah.')
                    </p>
                </div>

            </div>

            <div class="dash-topbar-user">

                <div class="dash-avatar">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>

                <div>
                    <strong>{{ Auth::user()->name }}</strong>
                    <small>{{ ucfirst(Auth::user()->role) }}</small>
                </div>

            </div>

        </header>

        <section>
            @yield('content')
        </section>

        <footer class="dash-footer">
            © {{ date('Y') }} Sistem Absensi SMAN 1 Jenamas
        </footer>

    </main>

</div>

<script>
    const layout = document.getElementById('dashLayout');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');

    function toggleSidebar() {
        if (window.innerWidth <= 768) {
            sidebar.classList.toggle('mobile-open');
            overlay.classList.toggle('show');
        } else {
            layout.classList.toggle('sidebar-collapsed');
        }
    }

    function closeSidebar() {
        sidebar.classList.remove('mobile-open');
        overlay.classList.remove('show');
    }

    window.addEventListener('resize', function () {
        if (window.innerWidth > 768) {
            closeSidebar();
        }
    });
</script>

</body>
</html>
