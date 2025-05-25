<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kecamatan;
use Illuminate\Support\Facades\Storage;

class KecamatanController extends Controller
{
    public function index()
    {
        $kecamatan = Kecamatan::all();
        return view("admin_views.kecamatan.index", compact("kecamatan"));
    }
    public function create()
    {
        return view("admin_views.kecamatan.create", [
            'kecamatan' => null,
        ]);
    }
    public function store(Request $request)
    {
        // dd($request);

        $request->validate([
            'nama_kecamatan' => 'required|string|max:255',
            'kode_pos' => 'required|string|max:10',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'geojson' => 'required|file|mimes:json,geojson,txt',
            'description' => 'nullable|string',
        ]);

        // dd($request->all());
        // handle geojson file
        if ($request->hasFile('image')) {
            $file_image = $request->file('image');
            $nama_file_image = time() . '_' . $file_image->getClientOriginalName();
            $file_path = $file_image->storeAs('kecamatan', $nama_file_image, 'public');
        } else {
            $nama_file_image = null;
        }
        $file_geojson = $request->file('geojson');
        $nama_file_geojson = $file_geojson->getClientOriginalName();
        $file_path = $file_geojson->storeAs('geojson', $nama_file_geojson, 'public');
        $kecamatan = Kecamatan::create([
            'nama_kecamatan' => $request->nama_kecamatan,
            'kode_pos' => $request->kode_pos,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'image' => $nama_file_image,
            'geojson' => $nama_file_geojson,
            'description' => $request->description,
        ]);

        return redirect()->route('kecamatan')->with('success', 'Kecamatan created successfully.');
    }

    public function detail($id)
    {
        $id = base64_decode($id, true);
        if ($id == false || !is_numeric($id)) {
            return null;
        }
        $kecamatan = Kecamatan::findOrFail($id);

        return $kecamatan;
    }

    public function edit($id)
    {
        $kecamatan = $this->detail($id);
        if (!$kecamatan) {
            return redirect()->route('kecamatan')->with('error', 'Kecamatan not found.');
        }
        return view("admin_views.kecamatan.create", compact("kecamatan"));
    }
    public function update(Request $request, $id)
    {
        $kecamatan = $this->detail($id);
        if (!$kecamatan) {
            return redirect()->route('kecamatan')->with('error', 'kecamatan tidak ditemukan');
        }

        $request->validate([
            'nama_kecamatan' => 'required|string|max:255',
            'kode_pos' => 'required|string|max:10',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'geojson' => 'nullable|file|mimes:json,geojson,txt',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('geojson')) {
            if ($kecamatan->geojson && Storage::disk('public')->exists('geojson/' . $kecamatan->geojson)) {
                Storage::disk('public')->delete('geojson/' . $kecamatan->geojson);
            }
            $file_geojson = $request->file('geojson');
            $nama_file_geojson = $file_geojson->getClientOriginalName();
            $file_path = $file_geojson->storeAs('geojson', $nama_file_geojson, 'public');
        } else {
            $nama_file_geojson = $kecamatan->geojson;
        }
        if ($request->hasFile('image')) {
            if ($kecamatan->image && Storage::disk('public')->exists('kecamatan/' . $kecamatan->image)) {
                Storage::disk('public')->delete('kecamatan/' . $kecamatan->image);
            }
            $file_image = $request->file('image');
            $nama_file_image = time() . '_' . $file_image->getClientOriginalName();
            $file_path = $file_image->storeAs('kecamatan', $nama_file_image, 'public');
        } else {
            $nama_file_image = $kecamatan->image;
        }
        $kecamatan->update([
            'nama_kecamatan' => $request->nama_kecamatan,
            'kode_pos' => $request->kode_pos,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'image' => $nama_file_image,
            'geojson' => $nama_file_geojson,
            'description' => $request->description,
        ]);
        return redirect()->route('kecamatan')->with('success', 'Kecamatan updated successfully.');
    }

    public function delete($id)
    {
        $kecamatan = $this->detail($id);
        if (!$kecamatan) {
            return response()->json([
                'status' => false,
                'message' => 'Kecamatan tidak ditemukan'
            ]);
        }
        if ($kecamatan->image && Storage::disk('public')->exists('kecamatan/' . $kecamatan->image)) {
            Storage::disk('public')->delete('kecamatan/' . $kecamatan->image);
        }
        if ($kecamatan->geojson && Storage::disk('public')->exists('geojson/' . $kecamatan->geojson)) {
            Storage::disk('public')->delete('geojson/' . $kecamatan->geojson);
        }
        $kecamatan->delete();
        return redirect()->route('kecamatan')->with('success', 'Kecamatan deleted successfully.');
    }
}
