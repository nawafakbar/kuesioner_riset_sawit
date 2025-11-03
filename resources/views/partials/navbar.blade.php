<nav class="navbar navbar-expand-lg navbar-light bg-white py-3 shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold text-primary" href="{{ route('home') }}">Riset IoT Sawit</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active fw-medium' : '' }}" href="{{ route('home') }}">Hasil Survei</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('survei.create') ? 'active fw-medium' : '' }}" href="{{ route('survei.create') }}">Isi Kuesioner</a>
                </li>
            </ul>
        </div>
    </div>
</nav>