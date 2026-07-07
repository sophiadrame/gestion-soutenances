<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Soutenances - ISI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, #1F4E79, #2E75B6);
            padding-top: 20px;
        }
        .sidebar a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 12px 20px;
            border-radius: 8px;
            margin: 4px 10px;
            transition: background 0.2s;
        }
        .sidebar a:hover, .sidebar a.active {
            background: rgba(255,255,255,0.2);
        }
        .sidebar .brand {
            color: #fff;
            font-size: 1.1rem;
            font-weight: bold;
            padding: 10px 20px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.2);
            margin-bottom: 10px;
        }
        .main-content { padding: 30px; }
        .card { border: none; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); }
        .badge-planifiée { background-color: #0d6efd; }
        .badge-en-cours { background-color: #ffc107; color:#000; }
        .badge-terminée { background-color: #198754; }
        .badge-annulée { background-color: #dc3545; }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2 sidebar p-0">
            <div class="brand">
                <a href="{{ route('dashboard') }}" style="color:#fff; text-decoration:none;">
                    <i class="bi bi-mortarboard-fill"></i> ISI Soutenances
                </a>
            </div>
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a href="{{ route('soutenances.index') }}" class="{{ request()->routeIs('soutenances.*') ? 'active' : '' }}">
                <i class="bi bi-calendar3"></i> Planning
            </a>
            <a href="{{ route('juries.index') }}" class="{{ request()->routeIs('juries.*') ? 'active' : '' }}">
                <i class="bi bi-people"></i> Jury
            </a>
            <a href="{{ route('pvs.index') }}" class="{{ request()->routeIs('pvs.*') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-text"></i> PV
            </a>
            <a href="{{ route('archives.index') }}" class="{{ request()->routeIs('archives.*') ? 'active' : '' }}">
                <i class="bi bi-archive"></i> Archivage
            </a>
            <a href="{{ route('profile.edit') }}" class="{{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                <i class="bi bi-person-circle"></i> Mon Profil
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" style="background:none; border:none; width:100%; text-align:left;">
                    <span style="color:#fff; text-decoration:none; display:block; padding: 12px 20px; border-radius: 8px; margin: 4px 10px;">
                        <i class="bi bi-box-arrow-right"></i> Déconnexion
                    </span>
                </button>
            </form>
        </div>

        <!-- Contenu principal -->
        <div class="col-md-10 main-content">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @yield('content')
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>