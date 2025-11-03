<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    protected $fillable = [
        'lokasi_kebun',
        'luas_kebun',
        'frekuensi_kerugian',
        'metode_pengamanan',
        'alasan_lolos',
        'perkiraan_kerugian',
    ];
}