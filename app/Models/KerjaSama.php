<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KerjaSama extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function PemilikUsaha()
    {
        return $this->belongsTo(User::class, "pemilik_usaha_id");
    }

    public function Supplier()
    {
        return $this->belongsTo(User::class, "supplier_id");
    }

    public function PermintaanBahanBakus()
    {
        return $this->hasMany(PermintaanBahanBaku::class);
    }
}
