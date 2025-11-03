@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card rounded-3 shadow-sm border-0">
                <div class="card-body p-4 p-sm-5">

                    <h1 class="h3 fw-bold text-dark mb-2">Survei Nasional Kerawanan "Ninja Sawit"</h1>
                    <p class="text-muted mb-4">
                        Kami sedang memetakan masalah pencurian sawit. Data Anda (100% anonim) akan digunakan untuk riset pengembangan teknologi keamanan kebun sawit swadaya.
                    </p>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <h5 class="alert-heading h6">Oops! Ada kesalahan:</h5>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('survei.store') }}" method="POST" class="mt-4">
                        @csrf

                        <div class="mb-4">
                            <label for="lokasi_kebun" class="form-label fw-medium">Di mana lokasi kebun Anda? *</label>
                            <select id="lokasi_kebun" name="lokasi_kebun" required class="form-select form-select-lg">
                                <option value="">Pilih Provinsi</option>
                                <option value="Riau">Riau</option>
                                <option value="Sumatera Utara">Sumatera Utara</option>
                                <option value="Sumatera Selatan">Sumatera Selatan</option>
                                <option value="Jambi">Jambi</option>
                                <option value="Kalimantan Tengah">Kalimantan Tengah</option>
                                <option value="Kalimantan Barat">Kalimantan Barat</option>
                                <option value="Kalimantan Timur">Kalimantan Timur</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-medium">Berapa luas kebun Anda? *</label>
                            @foreach(['1 - 5 Hektar', '6 - 10 Hektar', 'Lebih dari 10 Hektar'] as $option)
                            <div class="form-check">
                                <input id="luas_{{ $loop->index }}" name="luas_kebun" type="radio" value="{{ $option }}" required class="form-check-input">
                                <label for="luas_{{ $loop->index }}" class="form-check-label">{{ $option }}</label>
                            </div>
                            @endforeach
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-medium">Seberapa sering Anda mengalami kerugian akibat pencurian sawit? *</label>
                            @foreach(['Sering (Hampir setiap kali mendekati panen)', 'Cukup Sering (Beberapa kali dalam setahun)', 'Jarang / Tidak Pernah'] as $option)
                            <div class="form-check">
                                <input id="frek_{{ $loop->index }}" name="frekuensi_kerugian" type="radio" value="{{ $option }}" required class="form-check-input">
                                <label for="frek_{{ $loop->index }}" class="form-check-label">{{ $option }}</label>
                            </div>
                            @endforeach
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-medium">Apa metode pengamanan Anda saat ini? *</label>
                            @foreach(['Patroli / Ronda Manual', 'Pos Jaga', 'Tidak ada pengamanan khusus'] as $option)
                            <div class="form-check">
                                <input id="metode_{{ $loop->index }}" name="metode_pengamanan" type="radio" value="{{ $option }}" required class="form-check-input">
                                <label for="metode_{{ $loop->index }}" class="form-check-label">{{ $option }}</label>
                            </div>
                            @endforeach
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-medium">Jika Anda melakukan patroli/ronda, mengapa pencuri masih bisa lolos? <span class="text-muted fw-normal">(Opsional)</span></label>
                            @foreach(['Kebun terlalu luas untuk diawasi terus menerus', 'Kejadian terlalu cepat (baru tahu setelah kejadian)', 'Pencuri lebih pintar/tahu jadwal jaga'] as $option)
                            <div class="form-check">
                                <input id="alasan_{{ $loop->index }}" name="alasan_lolos" type="radio" value="{{ $option }}" class="form-check-input">
                                <label for="alasan_{{ $loop->index }}" class="form-check-label">{{ $option }}</label>
                            </div>
                            @endforeach
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-medium">Berapa perkiraan kerugian finansial Anda (rata-rata per bulan saat musim rawan)? *</label>
                            @foreach(['Kurang dari Rp 1.000.000', 'Rp 1.000.000 - Rp 5.000.000', 'Rp 5.000.000 - Rp 10.000.000', 'Lebih dari Rp 10.000.000'] as $option)
                            <div class="form-check">
                                <input id="rugi_{{ $loop->index }}" name="perkiraan_kerugian" type="radio" value="{{ $option }}" required class="form-check-input">
                                <label for="rugi_{{ $loop->index }}" class="form-check-label">{{ $option }}</label>
                            </div>
                            @endforeach
                        </div>

                        <div class="d-grid pt-3">
                            <button type="submit" class="btn btn-primary btn-sm">
                                Kirim Jawaban
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection