<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemilikPengeluaran extends Model
{
    use HasFactory;
    protected $guarded = ["id"];

    public function BahanBaku()
    {
        return $this->belongsTo(BahanBaku::class);
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }

}
