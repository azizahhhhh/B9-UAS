<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AkunPremium extends Model
{
    use HasFactory;
    protected $table = 'akun_premiums';
    protected $guarded = ['id'];

    protected $fillable = [
        'user_id',
        'no_rek',
        'tanggal_bayar',
        'expired_date',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'expired_date'=>'datetime',
        'tanggal_bayar'=>'datetime',
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }


}
