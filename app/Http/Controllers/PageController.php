<?php
namespace App\Http\Controllers;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function index()
    {
        // === Chart 1, 2, 3, 4 (Kode Lama, Tetap Ada) ===
        
        // Chart 1: Luas Kebun (Pie)
        $chartLuasKebun = Submission::query()
            ->select('luas_kebun', DB::raw('count(*) as total'))
            ->groupBy('luas_kebun')
            ->pluck('total', 'luas_kebun');

        // Chart 2: Perkiraan Kerugian (Bar)
        $chartKerugian = Submission::query()
            ->select('perkiraan_kerugian', DB::raw('count(*) as total'))
            ->groupBy('perkiraan_kerugian')
            ->orderByRaw("FIELD(perkiraan_kerugian, 
                'Kurang dari Rp 1.000.000', 
                'Rp 1.000.000 - Rp 5.000.000', 
                'Rp 5.000.000 - Rp 10.000.000', 
                'Lebih dari Rp 10.000.000')")
            ->pluck('total', 'perkiraan_kerugian');

        // Chart 3: Metode Pengamanan (Pie)
        $chartMetode = Submission::query()
            ->select('metode_pengamanan', DB::raw('count(*) as total'))
            ->groupBy('metode_pengamanan')
            ->pluck('total', 'metode_pengamanan');
            
        // Chart 4: Frekuensi Kerugian (Doughnut)
        $chartFrekuensi = Submission::query()
            ->select('frekuensi_kerugian', DB::raw('count(*) as total'))
            ->groupBy('frekuensi_kerugian')
            ->pluck('total', 'frekuensi_kerugian');

            
        // === [BARU] Chart 5: Grafik Kesimpulan (Metode vs Kerugian) ===

        // 1. Tentukan label dan segmennya dulu
        $metodeLabels = ['Patroli / Ronda Manual', 'Pos Jaga', 'Tidak ada pengamanan khusus'];
        $kerugianSegments = [
            'Kurang dari Rp 1.000.000', 
            'Rp 1.000.000 - Rp 5.000.000', 
            'Rp 5.000.000 - Rp 10.000.000', 
            'Lebih dari Rp 10.000.000'
        ];

        // 2. Siapkan array data pivot (kosong)
        $pivotData = [];
        foreach ($metodeLabels as $metode) {
            foreach ($kerugianSegments as $kerugian) {
                $pivotData[$metode][$kerugian] = 0;
            }
        }

        // 3. Ambil data mentah dari DB (dikelompokkan berdasarkan 2 kolom)
        $rawData = Submission::query()
            ->select('metode_pengamanan', 'perkiraan_kerugian', DB::raw('count(*) as total'))
            ->groupBy('metode_pengamanan', 'perkiraan_kerugian')
            ->get();

        // 4. Isi array pivot dengan data dari DB
        foreach ($rawData as $item) {
            if (isset($pivotData[$item->metode_pengamanan][$item->perkiraan_kerugian])) {
                $pivotData[$item->metode_pengamanan][$item->perkiraan_kerugian] = $item->total;
            }
        }

        // 5. Ubah data pivot menjadi format yang disukai Chart.js (datasets)
        $chartKesimpulanData = [
            'labels' => $metodeLabels,
            'datasets' => [],
        ];
        
        $colors = ['#20c997', '#ffc107', '#fd7e14', '#dc3545']; // Hijau, Kuning, Oranye, Merah
        
        foreach ($kerugianSegments as $index => $kerugian) {
            $dataset = [
                'label' => $kerugian,
                'data' => [],
                'backgroundColor' => $colors[$index],
                'borderRadius' => 4,
            ];
            foreach ($metodeLabels as $metode) {
                $dataset['data'][] = $pivotData[$metode][$kerugian];
            }
            $chartKesimpulanData['datasets'][] = $dataset;
        }


        // === Kirim Semua Data ke View ===
        return view('welcome', [
            'totalRespondents' => Submission::count(),
            'chartLuasKebun' => $chartLuasKebun,
            'chartKerugian' => $chartKerugian,
            'chartMetode' => $chartMetode,
            'chartFrekuensi' => $chartFrekuensi,
            'chartKesimpulanData' => $chartKesimpulanData, // Data baru!
        ]);
    }
}