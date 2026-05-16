<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Sistema de gestión para Bomberos Voluntarios de Sonoyta" />
    <meta name="theme-color" content="#cc2200" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="apple-mobile-web-app-title" content="FireApp" />
    <title>@yield('title') — FireApp</title>

    <link rel="manifest" href="/manifest.json" />
    <link rel="apple-touch-icon" href="/icons/apple-touch-icon.png" />
    <link rel="icon" type="image/png" href="/icons/favicon-32x32.png" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
    <link href="{{ asset('css/fireapp-dark.css') }}" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js"></script>

    <style>
        @keyframes pulseturno { 0%,100%{opacity:1} 50%{opacity:0.3} }

        *, *::before, *::after { box-sizing: border-box; }
        html, body { height: 100%; margin: 0; overflow-x: hidden; }
        body { background: #1a1a1a; font-family: 'Segoe UI', system-ui, sans-serif; display: flex; flex-direction: column; min-height: 100vh; min-width: 320px; }

        /* TOPBAR */
        .fa-topbar {
            background: #111;
            border-bottom: 1px solid #2a2a2a;
            height: 52px;
            display: flex;
            align-items: center;
            padding: 0 12px;
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 1000;
            gap: 8px;
        }
        .fa-topbar .brand { display: flex; align-items: center; gap: 8px; text-decoration: none; flex-shrink: 1; min-width: 0; }
        .fa-topbar .brand-icon { width: 30px; height: 30px; background: #cc2200; border-radius: 6px; display: flex; align-items: center; justify-content: center; font-size: 14px; color: #fff; }
        .fa-topbar .brand-name { font-size: 15px; font-weight: 600; color: #eee; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
        .fa-topbar .sidebar-toggle { background: none; border: none; color: #777; font-size: 16px; cursor: pointer; padding: 6px 8px; border-radius: 6px; transition: background 0.15s, color 0.15s; flex-shrink: 0; }
        .fa-topbar .sidebar-toggle:hover { background: #1e1e1e; color: #eee; }
        .fa-topbar .spacer { flex: 1; }
        .turno-badge { background: rgba(255,150,0,0.1); border: 1px solid rgba(255,150,0,0.3); color: #ffaa33; font-size: 11px; padding: 4px 10px; border-radius: 20px; display: flex; align-items: center; gap: 5px; white-space: nowrap; overflow: hidden; max-width: 200px; text-overflow: ellipsis; }
        .turno-dot { width: 6px; height: 6px; background: #ffaa33; border-radius: 50%; flex-shrink: 0; animation: pulseturno 1.5s infinite; }
        .fa-topbar .user-menu { position: relative; }
        .fa-topbar .user-avatar { width: 32px; height: 32px; background: #cc2200; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 12px; color: #fff; font-weight: 600; cursor: pointer; border: none; flex-shrink: 0; }
        .user-dropdown { position: absolute; right: 0; top: calc(100% + 8px); background: #1e1e1e; border: 1px solid #2a2a2a; border-radius: 8px; min-width: 160px; box-shadow: 0 8px 24px rgba(0,0,0,0.4); display: none; z-index: 2000; overflow: hidden; }
        .user-dropdown.open { display: block; }
        .user-dropdown a, .user-dropdown button { display: block; width: 100%; text-align: left; padding: 10px 14px; font-size: 13px; color: #aaa; background: none; border: none; cursor: pointer; text-decoration: none; transition: background 0.15s, color 0.15s; }
        .user-dropdown a:hover, .user-dropdown button:hover { background: #2a2a2a; color: #eee; }
        .user-dropdown hr { border-color: #2a2a2a; margin: 0; }

        /* LAYOUT */
        .fa-layout { display: flex; padding-top: 52px; min-height: 100vh; width: 100%; min-width: 0; }

        /* SIDEBAR */
        .fa-sidebar { width: 220px; background: #111; border-right: 1px solid #2a2a2a; display: flex; flex-direction: column; position: fixed; top: 52px; left: 0; bottom: 0; overflow-y: auto; transition: transform 0.25s ease; z-index: 900; }
        .fa-sidebar.collapsed { transform: translateX(-220px); }
        .fa-sidebar-section { padding: 14px 12px 4px; font-size: 10px; color: #555; text-transform: uppercase; letter-spacing: 1px; }
        .fa-sidebar a.nav-item { display: flex; align-items: center; gap: 10px; padding: 8px 12px; margin: 1px 6px; border-radius: 6px; font-size: 13px; color: #888; text-decoration: none; transition: background 0.15s, color 0.15s; }
        .fa-sidebar a.nav-item:hover { background: #1e1e1e; color: #ccc; }
        .fa-sidebar a.nav-item.active { background: rgba(204,34,0,0.15); color: #ff6b47; }
        .fa-sidebar a.nav-item .nav-icon { width: 18px; text-align: center; font-size: 14px; flex-shrink: 0; }
        .fa-sidebar a.nav-item .nav-arrow { margin-left: auto; font-size: 11px; transition: transform 0.2s; }
        .fa-sidebar a.nav-item.open .nav-arrow { transform: rotate(180deg); }
        .fa-sub-nav { display: none; padding: 2px 0; }
        .fa-sub-nav.open { display: block; }
        .fa-sub-nav a { display: block; padding: 6px 14px 6px 42px; font-size: 12px; color: #666; text-decoration: none; border-radius: 4px; margin: 1px 6px; transition: background 0.15s, color 0.15s; }
        .fa-sub-nav a:hover { color: #aaa; background: #1a1a1a; }
        .fa-sidebar-footer { margin-top: auto; padding: 12px 16px; border-top: 1px solid #2a2a2a; font-size: 11px; color: #555; line-height: 1.6; }
        .fa-sidebar-footer span { color: #999; }

        /* CONTENT */
        .fa-content { flex: 1; margin-left: 220px; transition: margin-left 0.25s ease; display: flex; flex-direction: column; min-height: calc(100vh - 52px); min-width: 0; width: calc(100% - 220px); }
        .fa-content.full { margin-left: 0; }
        .fa-content.full { width: 100%; }
        .fa-main { flex: 1; padding: 20px 24px; min-width: 0; width: 100%; }
        .fa-footer { background: #111; border-top: 1px solid #2a2a2a; padding: 10px 20px; font-size: 11px; color: #888; text-align: center; }
        .fa-footer a { color: #777; text-decoration: none; }
        .fa-footer a:hover { color: #aaa; }

        /* Mobile overlay */
        .sidebar-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 850; }
        .sidebar-overlay.active { display: block; }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .fa-sidebar { transform: translateX(-220px); }
            .fa-sidebar.mobile-open { transform: translateX(0); }
            .fa-content { margin-left: 0 !important; width: 100%; }
            .turno-badge { display: none !important; }
            .fa-main { padding: 14px; }
            .brand-name { display: none; }
        }
        @media (max-width: 480px) {
            .fa-main { padding: 10px; }
            .fa-topbar { padding: 0 8px; }
            .fa-sidebar { width: min(220px, 88vw); }
            .fa-sidebar.collapsed { transform: translateX(-100%); }
            .user-dropdown { right: -2px; min-width: min(180px, calc(100vw - 16px)); }
        }
        @media (max-height: 520px) and (max-width: 900px) {
            .fa-sidebar-footer { display: none; }
            .fa-sidebar-section { padding-top: 10px; }
        }
    </style>
</head>
<body>

{{-- TOPBAR --}}
<nav class="fa-topbar">
    <button class="sidebar-toggle" id="sidebarToggle" aria-label="Toggle sidebar">
        <i class="fas fa-bars"></i>
    </button>
    <a class="brand" href="{{ route('dashboard') }}">
        <div class="brand-icon"><i class="fas fa-fire"></i></div>
        <span class="brand-name">FireApp</span>
    </a>
    <div class="spacer"></div>
    @isset($turnoActivo)
    <div class="turno-badge d-none d-md-flex">
        <span class="turno-dot"></span>
        Turno: {{ $turnoActivo }}
    </div>
    @endisset
    <div class="user-menu">
        @auth
        <button class="user-avatar" id="userMenuBtn" title="{{ auth()->user()->name }}">
            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
        </button>
        @endauth
        <div class="user-dropdown" id="userDropdown">
            @auth
            <div style="padding:10px 14px;font-size:12px;color:#666;border-bottom:1px solid #2a2a2a;">
                {{ auth()->user()->name }}
            </div>
            @endauth
            <a href="{{ route('profile.edit') }}"><i class="fas fa-user-edit me-2" style="font-size:11px;color:#555"></i>Editar perfil</a>
            <hr>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"><i class="fas fa-sign-out-alt me-2" style="font-size:11px;color:#555"></i>Cerrar sesión</button>
            </form>
        </div>
    </div>
</nav>

{{-- SIDEBAR OVERLAY --}}
<div class="sidebar-overlay" id="sidebarOverlay"></div>

{{-- LAYOUT --}}
<div class="fa-layout">
    <aside class="fa-sidebar" id="sidebar">
        @php $currentRoute = request()->route()->getName(); $user = auth()->user(); @endphp

        <div class="fa-sidebar-section">Principal</div>
        <a href="{{ route('dashboard') }}" class="nav-item {{ $currentRoute === 'dashboard' ? 'active' : '' }}">
            <span class="nav-icon"><i class="fas fa-tachometer-alt"></i></span> Dashboard
        </a>

        <div class="fa-sidebar-section">Reportes</div>
        <a href="{{ route('unit_reports.index') }}" class="nav-item {{ str_starts_with($currentRoute ?? '', 'unit_reports') ? 'active' : '' }}">
            <span class="nav-icon"><i class="fas fa-truck"></i></span> Unidades
        </a>
        <a href="{{ route('installation_reports.index') }}" class="nav-item {{ str_starts_with($currentRoute ?? '', 'installation_reports') ? 'active' : '' }}">
            <span class="nav-icon"><i class="fas fa-building"></i></span> Instalaciones
        </a>
        <a href="{{ route('news_reports.index') }}" class="nav-item {{ str_starts_with($currentRoute ?? '', 'news_reports') ? 'active' : '' }}">
            <span class="nav-icon"><i class="fas fa-bell"></i></span> Novedades
        </a>

        @if($user->hasRole('admin'))
        <div class="fa-sidebar-section">Admin</div>
        <a href="{{ route('users.index') }}" class="nav-item {{ str_starts_with($currentRoute ?? '', 'users') ? 'active' : '' }}">
            <span class="nav-icon"><i class="fas fa-users"></i></span> Usuarios
        </a>
        <a href="#" class="nav-item {{ str_starts_with($currentRoute ?? '', 'config') ? 'active open' : '' }}" id="configToggle">
            <span class="nav-icon"><i class="fas fa-cogs"></i></span> Configuración
            <i class="fas fa-chevron-down nav-arrow"></i>
        </a>
        <div class="fa-sub-nav {{ str_starts_with($currentRoute ?? '', 'config') ? 'open' : '' }}" id="configSub">
            <a href="{{ route('config.vehicles.index') }}" style="{{ str_starts_with($currentRoute ?? '', 'config.vehicles') ? 'color:#ff6b47' : '' }}">Unidades</a>
            <a href="{{ route('config.areas.index') }}" style="{{ str_starts_with($currentRoute ?? '', 'config.areas') ? 'color:#ff6b47' : '' }}">Áreas del cuartel</a>
        </div>
        @endif

        <div class="fa-sidebar-footer">
            Usuario:<br>
            @auth<span>{{ auth()->user()->name }}</span>@endauth
        </div>
    </aside>

    <div class="fa-content" id="faContent">
        <main class="fa-main">
            @yield('content')
        </main>
        <footer class="fa-footer">
            Copyright &copy; Ing. Karolina Arvizu {{ date('Y') }} &mdash;
            <a href="https://www.sonoytasoftware.com" target="_blank">sonoytasoftware.com</a>
        </footer>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
const sidebar = document.getElementById('sidebar');
const faContent = document.getElementById('faContent');
const overlay = document.getElementById('sidebarOverlay');
const toggleBtn = document.getElementById('sidebarToggle');
let collapsed = false;

toggleBtn.addEventListener('click', function() {
    if (window.innerWidth <= 768) {
        sidebar.classList.toggle('mobile-open');
        overlay.classList.toggle('active');
    } else {
        collapsed = !collapsed;
        sidebar.classList.toggle('collapsed', collapsed);
        faContent.classList.toggle('full', collapsed);
    }
});
overlay.addEventListener('click', function() {
    sidebar.classList.remove('mobile-open');
    overlay.classList.remove('active');
});

const configToggle = document.getElementById('configToggle');
const configSub = document.getElementById('configSub');
if (configToggle) {
    configToggle.addEventListener('click', function(e) {
        e.preventDefault();
        this.classList.toggle('open');
        configSub.classList.toggle('open');
    });
}

const userMenuBtn = document.getElementById('userMenuBtn');
const userDropdown = document.getElementById('userDropdown');
if (userMenuBtn) {
    userMenuBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        userDropdown.classList.toggle('open');
    });
    document.addEventListener('click', function() {
        userDropdown.classList.remove('open');
    });
}
</script>
<script>
if ('serviceWorker' in navigator) {
    window.addEventListener('load', function() {
        navigator.serviceWorker.register('/sw.js');
    });
}
</script>
@yield('scripts')
</body>
</html>
