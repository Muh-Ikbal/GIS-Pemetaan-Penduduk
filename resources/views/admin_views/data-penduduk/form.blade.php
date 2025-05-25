@extends('admin_views.template.app')
@section('content')
  <div class="col-12 py-4 px-3">
    <div class="card mb-4">
      <div class="px-3 pt-3">
        <a class="btn btn-outline-primary mb-0 text-end" href="{{ route('data-penduduk.index') }}">Kembali</a>
      </div>
      <div class="card-header pb-0">
        {{-- <h6>Buat Kecamatan</h6> --}}
      </div>
      <div class="card-body px-0 pt-0 pb-2">

        <div class="ps-3 pe-5 form-group">
          <form
            action="{{ $dataPenduduk ? route('data-penduduk.update', base64_encode($dataPenduduk->id)) : route('data-penduduk.store') }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            @if ($dataPenduduk)
              @method('PUT')
            @endif
            <div class="mb-3">
              <label for="kecamatan-id" class="form-label">Kecamatan</label>
              <select name="kecamatan_id" id="kecamatan-id"
                class="form-select @error('kecamatan_id') is-invalid @enderror">
                @foreach ($kecamatan as $item)
                  <option value="{{ $item->id }}"
                    {{ old('kecamatan_id', isset($dataPenduduk) ? $dataPenduduk->kecamatan_id : '') == $item->id ? 'selected' : '' }}>
                    {{ $item->nama_kecamatan }}
                  </option>
                @endforeach
              </select>
              @error('kecamatan_id')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="kepadatan-penduduk" class="form-label">Kepadatan Penduduk</label>
              <input type="number" min="0" class="form-control @error('kepadatan_penduduk') is-invalid @enderror"
                value="{{ old('kepadatan_penduduk', $dataPenduduk->kepadatan_penduduk ?? '') }}" id="kepadatan-penduduk"
                name="kepadatan_penduduk" required>
              @error('kepadatan_penduduk')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="jumlah-penduduk" class="form-label">Jumlah Penduduk</label>
              <input type="number" min="0" class="form-control @error('jumlah_penduduk') is-invalid @enderror"
                value="{{ old('jumlah_penduduk', $dataPenduduk->jumlah_penduduk ?? '') }}" id="jumlah-penduduk"
                name="jumlah_penduduk" required>
              @error('jumlah_penduduk')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="laki-laki" class="form-label">Jumalah Laki-Laki</label>
              <input type="number" min="0" class="form-control @error('jumlah_laki_laki') is-invalid @enderror"
                value="{{ old('jumlah_laki_laki', $dataPenduduk->jumlah_laki_laki ?? '') }}" id="laki-laki"
                name="jumlah_laki_laki" required>
              @error('jumlah_laki_laki')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="jumlah-perempuan" class="form-label">Jumlah Perempuan</label>
              <input type="number" min="0" class="form-control @error('jumlah_perempuan') is-invalid @enderror"
                value="{{ old('jumlah_perempuan', $dataPenduduk->jumlah_perempuan ?? '') }}" id="jumlah-perempuan"
                name="jumlah_perempuan" required>
              @error('jumlah_perempuan')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="tahun" class="form-label">Tahun</label>
              <input type="number" min="2000" max="2999"
                class="form-control @error('tahun') is-invalid @enderror"
                value="{{ old('tahun', $dataPenduduk->tahun ?? '') }}" id="tahun" name="tahun" required>
              @error('tahun')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="d-flex justify-content-end w-full align-items-end">
              <button type="submit" class="btn btn-success">{{ $dataPenduduk ? 'Update' : 'Simpan' }}</button>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>
@endsection
