<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class PemilikBahanBaku extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    // protected $table = "pemilik_bahan_bakus";
    protected $guarded = ["id"];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection("gambar-bahan-baku");
    }

    public function BahanBaku()
    {
        return $this->belongsTo(BahanBaku::class);
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function PermintaanBahanBakus()
    {
        return $this->hasMany(PermintaanBahanBaku::class);
    }
}
