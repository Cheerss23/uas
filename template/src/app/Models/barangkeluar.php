<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;

    protected $fillable = [
        'barang_id',
        'jumlah_keluar',
        'tanggal_keluar',
        'keterangan',
    ];

    protected static function booted()
    {
        static::created(function ($barangKeluar) {
            $barang = $barangKeluar->barang;

            if ($barang->stok >= $barangKeluar->jumlah_keluar) {
                $barang->stok -= $barangKeluar->jumlah_keluar;
                $barang->save();
            } else {
                throw new \Exception('Stok tidak mencukupi untuk pengeluaran barang.');
            }
        });
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
