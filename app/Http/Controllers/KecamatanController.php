<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kecamatan;

class KecamatanController extends Controller
{
    public function index()
    {
        $kecamatan = Kecamatan::all();
        return view("welcome", compact("kecamatan"));
    }
    public function create()
    {
        return view("admin_views.form");
    }
    public function store(Request $request)
    {
        // dd($request);

        $request->validate([
            'nama_kecamatan' => 'required|string|max:255',
            'kode_pos' => 'required|string|max:10',
            'geojson' => 'required|file|mimes:json,geojson,txt',
            'description' => 'nullable|string',
        ]);
        $file = $request->file('geojson');
        $nama_file = $file->getClientOriginalName();
        $filePath = $file->storeAs('geojson', $nama_file, 'public');
        $kecamatan = Kecamatan::create([
            'nama_kecamatan' => $request->nama_kecamatan,
            'kode_pos' => $request->kode_pos,
            'geojson' => $nama_file,
            'description' => $request->description,
        ]);

        return redirect()->route('welcome')->with('success', 'Kecamatan created successfully.');
    }
}
