<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataPenduduk;
use App\Models\Kecamatan;


class UserViewController extends Controller
{
    public function home()
    {

        return view("user_views.home");
    }
    public function maps()
    {
        return view("user_views.maps");
    }

    public function getDataPenduduk()
    {
        $dataPenduduk = DataPenduduk::with('kecamatan')->get();

        return response()->json($dataPenduduk);
    }

    public function getDataKecamatan()
    {
        try {
            $dataKecamatan = Kecamatan::all();
            return response()->json($dataKecamatan);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Data not found'], 404);
        }
    }
    // public function getDetailKecamatan($id){
    //     try{
    //         $kecamatan = Kecamatan::findOrFail($id);
    //         return response()->json($kecamatan);
    //     }catch (\Exception $e) {
    //         return response()->json(['error' => 'Kecamatan not found'], 404);
    //     }
    // }
    public function laporan($id)
    {
        try {
            $dataKecamatan = Kecamatan::findOrFail($id);

            $dataPenduduk = DataPenduduk::where('kecamatan_id', $id)->get();
            return response()->json([
                "status" => "success",
                'kecamatan' => $dataKecamatan,
                'penduduk' => $dataPenduduk
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Data not found'], 404);
        }
    }
}
