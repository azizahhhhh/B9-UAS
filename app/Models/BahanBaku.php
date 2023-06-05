<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BahanBaku extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function PemilikBahanBakus()
    {
        return $this->hasMany(PemilikBahanBaku::class);
    }
    public function PemilikPemasukans()
    {
        return $this->hasMany(PemilikBahanBaku::class);
    }

    public function SupplierBahanBakus()
    {
        return $this->hasMany(SupplierBahanBaku::class);
    }
    public function SupplierPemasukans()
    {
        return $this->hasMany(SupplierBahanBaku::class);
    }
}
