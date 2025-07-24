<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;

    protected $fillable = [
        'barang_id',
        'jumlah_masuk',
        'tanggal_masuk',
        'keterangan',
    ];

    protected static function booted()
    {
        static::created(function ($barangMasuk) {
            $barang = $barangMasuk->barang;
            $barang->stok += $barangMasuk->jumlah_masuk;
            $barang->save();
        });
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
