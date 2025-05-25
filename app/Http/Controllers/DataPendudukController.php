<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataPenduduk;
use App\Models\Kecamatan;

class DataPendudukController extends Controller
{
    public function index()
    {
        $dataPenduduk = DataPenduduk::with('kecamatan')->orderBy('tahun', 'desc')->get()->groupBy('tahun');
        return view('admin_views.data-penduduk.index', compact('dataPenduduk'));
    }

    public function create()
    {
        $kecamatan = Kecamatan::all();

        return view('admin_views.data-penduduk.form', [
            'kecamatan' => $kecamatan,
            'dataPenduduk' => null,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kepadatan_penduduk' => 'required|numeric',
            'jumlah_penduduk' => 'required|numeric',
            'jumlah_laki_laki' => 'nullable|numeric',
            'jumlah_perempuan' => 'nullable|numeric',
            'kecamatan_id' => 'required|exists:kecamatan,id',
            'tahun' => 'required|integer|min:2000|max:2099',
        ]);
        DataPenduduk::create($request->all());
        return redirect()->route('data-penduduk.index')->with('success', 'Data Penduduk Berhasil Ditambahkan');
    }

    public function detail($id)
    {
        $id = base64_decode($id, true);
        if ($id == false || !is_numeric($id)) {
            return null;
        }
        $dataPenduduk = DataPenduduk::findOrFail($id);
        return $dataPenduduk;
    }
    public function edit($id)
    {
        $dataPenduduk = $this->detail($id);
        $kecamatan = Kecamatan::all();
        if (!$dataPenduduk) {
            return redirect()->route('data-penduduk.index')->with('error', 'Data Penduduk Tidak Ditemukan');
        }
        return view('admin_views.data-penduduk.form', [
            'dataPenduduk' => $dataPenduduk,
            'kecamatan' => $kecamatan,
        ]);
    }

    public function update(Request $request, $id)
    {
        $dataPenduduk = $this->detail($id);
        if (!$dataPenduduk) {
            return redirect()->route('data-penduduk.index')->with('error', 'Data Penduduk Tidak Ditemukan');
        }
        $request->validate([
            'kepadatan_penduduk' => 'required|numeric',
            'jumlah_penduduk' => 'required|numeric',
            'jumlah_laki_laki' => 'nullable|numeric',
            'jumlah_perempuan' => 'nullable|numeric',
            'kecamatan_id' => 'required|exists:kecamatan,id',
            'tahun' => 'required|integer|min:2000|max:2099',
        ]);
        $dataPenduduk->update($request->all());
        return redirect()->route('data-penduduk.index')->with('success', 'Data Penduduk Berhasil Diupdate');
    }
    public function delete($id)
    {
        $dataPenduduk = $this->detail($id);
        if (!$dataPenduduk) {
            return redirect()->route('data-penduduk.index')->with('error', 'Data Penduduk Tidak Ditemukan');
        }
        $dataPenduduk->delete();
        return redirect()->route('data-penduduk.index')->with('success', 'Data Penduduk Berhasil Dihapus');
    }
}
