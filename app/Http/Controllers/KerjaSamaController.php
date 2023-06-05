<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\KerjaSama;
use Illuminate\Http\Request;
use App\Models\PemilikBahanBaku;
use App\Models\SupplierBahanBaku;
use Illuminate\Support\Facades\DB;
use App\Models\PermintaanBahanBaku;
use Illuminate\Support\Facades\Auth;

class KerjaSamaController extends Controller
{
    public function index()
    {  
        return view("pages.kerja-sama.index")->with([
            "suppliers" => User::with("KerjaSama")->whereHas("roles", function ($query) {
                $query->whereName("Supplier");
            })->get(),
            "bahan_bakus" => SupplierBahanBaku::all(),
            "owners" => KerjaSama::with("Supplier", "PemilikUsaha")->whereSupplierId(Auth::user()->id)->get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            "supplier" => "integer|exists:users,id",
        ]);
        DB::beginTransaction();
        try {
            if ($this->alreadyCooperate($request->supplier)) {
                DB::rollBack();
                return redirect()->back()->with("error", "Anda sudah mengajak kerja sama dengan supplier ini");
            }
            KerjaSama::create([
                "pemilik_usaha_id" => Auth::user()->id,
                "supplier_id" => $request->supplier
            ]);
            DB::commit();
            return redirect()->back()->with("success", "Ajakan kerja sama telah dikirim. Harap menunggu persetujuan dari pihak supplier");
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with("error", $e->getMessage());
        }
    }

    public function storePermintaan(Request $request, $kerjaSama_id)
    {  
        $request->validate([
            "kerja_sama_id" => "integer|exists:kerja_samas,id",
            "barang_baku" => "integer|exists:bahan_bakus,id",
            "permintaan" => "required",
        ]);
        DB::beginTransaction();
        try {
            PermintaanBahanBaku::create([
                "kerja_sama_id" => $kerjaSama_id,
                "supplier_bahan_baku_id" => $request->barang_baku,
                "request" => $request->permintaan,
            ]);
            DB::commit();
            return redirect()->back()->with("success", "Permintaan berhasil dikirim");
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with("error", $e->getMessage());
        }
    }

    public function index_riwayat(KerjaSama $kerjaSama)
    {
        if (Auth::user()->hasRole("Supplier")) {
            PermintaanBahanBaku::whereKerjaSamaId($kerjaSama->id)->update([
                "telah_dibaca" => 1,
            ]);
        }
        if(Auth::user()->is_premium){
            return view("pages.kerja-sama.riwayat")->with([
                "requests_owner" => PermintaanBahanBaku::with(["KerjaSama"])->whereKerjaSamaId($kerjaSama->id)->get(),
                "requests_supplier" => PermintaanBahanBaku::with(["KerjaSama"])->whereKerjaSamaId($kerjaSama->id)->get(),
            ]);
        }else{
            return view("pages.kerja-sama.riwayat")->with([
                "requests_owner" => PermintaanBahanBaku::with(["KerjaSama"])->whereKerjaSamaId($kerjaSama->id)->get(),
                "requests_supplier" => PermintaanBahanBaku::with(["KerjaSama"])->whereKerjaSamaId($kerjaSama->id)->limit(3)->get(),
            ]);
        }
    }

    public function updateKerjaSama(Request $request, KerjaSama $kerjaSama)
    {
        $request->validate([
            "persetujuan" => "in:Diterima,Ditolak"
        ]);
        if ($request->persetujuan === "Diterima") {
            $kerjaSama->update([
                "is_accepted" => "Diterima"
            ]);
            return redirect()->back()->with("success", "Anda telah menyetujui kerja sama");
        }
        $kerjaSama->update([
            "is_accepted" => "Ditolak"
        ]);
        return redirect()->back()->with("warning", "Anda telah menolak kerja sama");
    }

    private function alreadyCooperate($supplier_id)
    {
        return KerjaSama::wherePemilikUsahaId(Auth::user()->id)->whereSupplierId($supplier_id)->exists();
    }
}
