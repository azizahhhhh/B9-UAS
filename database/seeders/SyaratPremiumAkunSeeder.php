<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SyaratPremiumAkun;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SyaratPremiumAkunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SyaratPremiumAkun::create([
            'body' => '
            <div class="font-bold text-xl">Pembayaran dan Langganan:</div><ul class="pb-2"><li>Pengguna harus membayar biaya berlangganan bulanan atau tahunan untuk mendapatkan akses ke akun premium.</li><li>Biaya berlangganan dapat berubah dari waktu ke waktu dan akan dikenakan secara otomatis pada periode berlangganan berikutnya kecuali pengguna membatalkannya.</li></ul><div class="font-bold text-xl">Akses Fitur Tambahan:</div><ul class="pb-2"><li>Akun premium memberikan akses ke fitur tambahan yang tidak tersedia pada akun gratis.</li><li>Fitur tambahan dapat mencakup konten eksklusif, penghapusan iklan, peningkatan kapasitas penyimpanan, akses prioritas, atau fitur khusus lainnya.</li></ul><div class="font-bold text-xl">Pembatalan dan Pengembalian Dana:</div><ul class="pb-2"><li>Pengguna dapat membatalkan langganan akun premium kapan saja, namun beberapa layanan mungkin membatasi pembatalan hanya setelah periode langganan tertentu.</li><li>Biaya pembatalan mungkin berlaku jika langganan dibatalkan sebelum periode minimum yang ditentukan berakhir.</li><li>Kebijakan pengembalian dana dapat bervariasi, dan beberapa layanan mungkin tidak menyediakan pengembalian dana setelah langganan dimulai.</li></ul><div class="font-bold text-xl">Perubahan Syarat dan Ketentuan:</div><ul class="pb-2"><li>Layanan berhak mengubah syarat dan ketentuan akun premium mereka.</li><li>Pengguna biasanya akan diberi pemberitahuan tentang perubahan tersebut melalui email atau pengumuman di platform.</li><li>Jika pengguna tidak setuju dengan perubahan, mereka mungkin memiliki opsi untuk membatalkan langganan.</li></ul><div class="font-bold text-xl">Kebijakan Penggunaan:</div><ul class="pb-2"><li>Pengguna harus mematuhi kebijakan penggunaan yang ditetapkan oleh platform atau layanan.</li><li>Pelanggaran terhadap kebijakan penggunaan dapat mengakibatkan penangguhan atau penghentian akun premium.</li></ul><div class="font-bold text-xl"><br></div>
            '
        ]);
    }
}
