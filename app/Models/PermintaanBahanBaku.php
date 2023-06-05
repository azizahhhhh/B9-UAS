<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermintaanBahanBaku extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function KerjaSama()
    {
        return $this->belongsTo(KerjaSama::class);
    }

    public function PemilikBahanBaku()
    {
        return $this->belongsTo(PemilikBahanBaku::class);
    }
    public function SupplierBahanBaku()
    {
        return $this->belongsTo(SupplierBahanBaku::class);
    }
}
