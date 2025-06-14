@extends('admin_views.template.app')
@section('content')
  <div class="col-12 py-4 px-3">
    <div class="card mb-4">
      <div class="px-3 pt-3">
        <a class="btn btn-outline-primary mb-0 text-end" href="{{ route('kecamatan') }}">Kembali</a>
      </div>
      <div class="card-header pb-0">
        {{-- <h6>Buat Kecamatan</h6> --}}
      </div>
      <div class="card-body px-0 pt-0 pb-2">

        <div class="ps-3 pe-5 form-group">
          <form
            action="{{ $kecamatan ? route('kecamatan.update', base64_encode($kecamatan->id)) : route('kecamatan.store') }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            @if ($kecamatan)
              @method('PUT')
            @endif
            <div class="mb-3">
              <label for="nama-kecamatan" class="form-label">Nama Kecamatan</label>
              <input type="text" class="form-control @error('nama_kecamatan') is-invalid @enderror" id="nama-kecamatan"
                value="{{ old('nama_kecamatan', $kecamatan->nama_kecamatan ?? '') }}" name="nama_kecamatan" required>
              @error('nama_kecamatan')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="kode-pos" class="form-label">Kode Pos</label>
              <input type="text" class="form-control @error('kode_pos') is-invalid @enderror"
                value="{{ old('kode_pos', $kecamatan->kode_pos ?? '') }}" id="kode-pos" name="kode_pos" required>
              @error('kode_pos')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="luas" class="form-label">Luas Kecamatan</label>
              <input type="text" class="form-control @error('luas') is-invalid @enderror"
                value="{{ old('luas', $kecamatan->luas ?? '') }}" id="luas" name="luas" required>
              @error('luas')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="description" class="form-label">Deskripsi</label>
              <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                rows="3">{{ old('description', $kecamatan->description ?? '') }}</textarea>
              @error('description')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="longitude" class="form-label">Longitude</label>
              <input type="string" class="form-control @error('longitude') is-invalid @enderror"
                value="{{ old('longitude', $kecamatan->longitude ?? '') }}" id="longitude" name="longitude" required>
              @error('longitude')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="latitude" class="form-label">Latitude</label>
              <input type="string" class="form-control @error('latitude') is-invalid @enderror"
                value="{{ old('latitude', $kecamatan->latitude ?? '') }}" id="latitude" name="latitude" required>
              @error('latitude')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="geojson" class="form-label">GeoJSON File</label>
              <input type="file" class="form-control @error('geojson') is-invalid @enderror"
                value="{{ old('geojson', $kecamatan->geojson ?? '') }}" id="geojson" name="geojson"
                accept=".geojson,.json" {{ !$kecamatan ? 'required' : '' }}>
              @error('geojson')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="image" class="form-label">Gambar Kecamatan</label>
              <input type="file" class="form-control @error('image') is-invalid @enderror" value="{{ old('image') }}"
                id="image" name="image" accept=".jpg,.png,.jpeg" {{ !$kecamatan ? 'required' : '' }}>
              @error('image')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="d-flex justify-content-end w-full align-items-end">
              <button type="submit" class="btn btn-success">{{ $kecamatan ? 'Update' : 'Simpan' }}</button>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>
@endsection
