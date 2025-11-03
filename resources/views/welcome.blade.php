@extends('layouts.app')

@section('content')
<div class="container py-5">

    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold text-dark">Hasil Live Survei Kerawanan Sawit</h1>
        <p class="fs-4 text-muted mt-2">
            Data transparansi ini dikumpulkan dari petani sawit swadaya di seluruh Indonesia.
        </p>
        <p class="fs-5 fw-medium text-primary mt-3">Total Responden: {{ $totalRespondents }} Petani</p>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4">

        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold text-dark mb-4">Grafik Kerugian Finansial per Bulan</h5>
                    <canvas id="chartKerugian" height="200"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold text-dark mb-4">Grafik Frekuensi Kerugian</h5>
                    <canvas id="chartFrekuensi" height="200"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold text-dark mb-4">Grafik Profil: Luas Kebun</h5>
                    <canvas id="chartLuasKebun" height="200"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold text-dark mb-4">Grafik Profil: Metode Pengamanan</h5>
                    <canvas id="chartMetode" height="200"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold text-dark mb-4">Grafik Lokasi Responden</h5>
                    <canvas id="chartLokasi"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold text-dark mb-4">Grafik Kesimpulan: Kerugian Berdasarkan Metode Pengamanan</h5>
                    <p class="card-subtitle mb-3 text-muted">Grafik ini menunjukkan perbandingan kerugian (segmen warna) untuk setiap metode pengamanan (sumbu X).</p>
                        <div style="position: relative; height: 50vh; min-height: 300px;">
                    <canvas id="chartKesimpulan"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
    // Data dari Controller
    const dataKerugian = @json($chartKerugian);
    const dataFrekuensi = @json($chartFrekuensi);
    const dataLuasKebun = @json($chartLuasKebun);
    const dataMetode = @json($chartMetode);
    const dataKesimpulan = @json($chartKesimpulanData);
    const dataLokasi = @json($chartLokasi);

    // 1. Chart Kerugian (Bar)
    new Chart(document.getElementById('chartKerugian'), {
        type: 'bar',
        data: {
            labels: Object.keys(dataKerugian),
            datasets: [{
                label: 'Jumlah Responden',
                data: Object.values(dataKerugian),
                backgroundColor: '#dc3545', // Warna Merah Bootstrap
                borderRadius: 4,
            }]
        },
        options: {
            indexAxis: 'y', // Horizontal Bar
            plugins: { legend: { display: false } }
        }
    });

    // 2. Chart Frekuensi (Doughnut)
    new Chart(document.getElementById('chartFrekuensi'), {
        type: 'doughnut',
        data: {
            labels: Object.keys(dataFrekuensi),
            datasets: [{
                data: Object.values(dataFrekuensi),
                backgroundColor: ['#dc3545', '#ffc107', '#198754'], // Merah, Kuning, Hijau
            }]
        },
        options: { responsive: true }
    });

    // 3. Chart Luas Kebun (Pie)
    new Chart(document.getElementById('chartLuasKebun'), {
        type: 'pie',
        data: {
            labels: Object.keys(dataLuasKebun),
            datasets: [{
                data: Object.values(dataLuasKebun),
                backgroundColor: ['#0d6efd', '#ffc107', '#6f42c1'], // Biru, Kuning, Ungu
            }]
        },
        options: { responsive: true }
    });

    // 4. Chart Metode Pengamanan (Pie)
    new Chart(document.getElementById('chartMetode'), {
        type: 'pie',
        data: {
            labels: Object.keys(dataMetode),
            datasets: [{
                data: Object.values(dataMetode),
                backgroundColor: ['#fd7e14', '#6f42c1', '#20c997'], // Orange, Ungu, Teal
            }]
        },
        options: { responsive: true }
    });

    // 5. kesimpulan
    new Chart(document.getElementById('chartKesimpulan'), {
    type: 'bar',
    data: dataKesimpulan,
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
        legend: { position: 'top' },
        },
        scales: {
        x: { stacked: true },
        y: { stacked: true, beginAtZero: true }
        }
    }
    }); 

    // 6. [BARU] Chart Lokasi (Horizontal Bar)
    new Chart(document.getElementById('chartLokasi'), {
        type: 'bar',
        data: {
            labels: Object.keys(dataLokasi),
            datasets: [{
                label: 'Jumlah Responden',
                data: Object.values(dataLokasi),
                backgroundColor: '#0d6efd', // Biru
                borderRadius: 4,
            }]
        },
        options: {
            indexAxis: 'y', // <-- Bikin jadi horizontal
            plugins: { legend: { display: false } }
        }
    });

</script>
@endpush