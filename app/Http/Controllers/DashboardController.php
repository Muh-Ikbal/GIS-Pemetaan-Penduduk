<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kecamatan;
use App\Models\DataPenduduk;

class DashboardController extends Controller
{
    public function index()
    {
        $kecamatanCount = Kecamatan::all()->count();
        $maxTahun = DataPenduduk::max('tahun');

        $avgPenduduk = DataPenduduk::where('tahun', $maxTahun)
            ->selectRaw('AVG(CAST(jumlah_penduduk AS DECIMAL)) as avg')
            ->value('avg');

        if ($avgPenduduk === null) {
            $avgPenduduk = 0;
        }

        $avgKepadatan = DataPenduduk::where('tahun', $maxTahun)
            ->selectRaw('AVG(CAST(kepadatan_penduduk AS DECIMAL)) as avg')
            ->value('avg');

        if ($avgKepadatan === null) {
            $avgKepadatan = 0;
        }

        return view('admin_views.dashboard', compact('kecamatanCount', 'avgPenduduk', 'avgKepadatan', 'maxTahun'));
    }

    public function chartPenduduk()
    {
        $data = DataPenduduk::with('kecamatan')
            ->selectRaw('kecamatan_id, tahun, SUM(CAST(jumlah_penduduk AS DECIMAL)) as jumlah_penduduk')
            ->groupBy('kecamatan_id', 'tahun')
            ->orderBy('tahun')
            ->get();

        $kecamatanList = $data->groupBy('kecamatan_id');
        $labels = $data->pluck('tahun')->unique()->values();
        $datasets = [];

        foreach ($kecamatanList as $kecamatanId => $items) {
            $namaKecamatan = $items->first()->kecamatan->nama_kecamatan;
            $dataPerTahun = [];

            foreach ($labels as $tahun) {
                $dataTahun = $items->firstWhere('tahun', $tahun);
                $dataPerTahun[] = $dataTahun ? $dataTahun->jumlah_penduduk : 0;
            }

            $datasets[] = [
                'label' => $namaKecamatan,
                'data' => $dataPerTahun,
                'tension' => 0.4,
                'pointRadius' => 0,
                'borderWidth' => 3,
                'maxBarThickness' => 6,
            ];
        }

        return response()->json([
            'labels' => $labels,
            'datasets' => $datasets,
        ]);
    }
}
