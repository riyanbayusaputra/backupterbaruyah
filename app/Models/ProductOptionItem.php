<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductOptionItem extends Model
{
    protected $fillable = [
        'product_option_id',
        'name',
       // Tambahkan jika ada kolom gambar
    ];

    // Relasi ke ProductOption (parent)
    public function productOption()
    {
        return $this->belongsTo(ProductOption::class);
    }
    // Relasi ke Product (grandparent)

    // Jika ingin akses produk langsung lewat relasi, bisa pakai hasOneThrough (opsional)
    // atau akses lewat $this->productOption->product
}
