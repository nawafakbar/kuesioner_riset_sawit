<?php
namespace App\Http\Controllers;
use App\Models\Submission;
use Illuminate\Http\Request;

class QuestionnaireController extends Controller
{
    public function create()
    {
        return view('kuesioner');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'lokasi_kebun' => 'required|string|max:255',
            'luas_kebun' => 'required|string|max:255',
            'frekuensi_kerugian' => 'required|string|max:255',
            'metode_pengamanan' => 'required|string|max:255',
            'alasan_lolos' => 'nullable|string|max:255',
            'perkiraan_kerugian' => 'required|string|max:255',
        ]);

        Submission::create($validated);

        return redirect()->route('home')->with('success', 'Terima Kasih! Data Anda telah terekam. Hasil survei akan tampil di halaman ini.');
    }
}