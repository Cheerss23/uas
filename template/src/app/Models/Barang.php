<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nama_barang',
        'kategori',
        'kode_barang',
        'stok',
        'harga',
    ];

    public function barangMasuk()
    {
        return $this->hasMany(BarangMasuk::class);
    }

    public function barangKeluar()
    {
        return $this->hasMany(BarangKeluar::class);
    }
}
