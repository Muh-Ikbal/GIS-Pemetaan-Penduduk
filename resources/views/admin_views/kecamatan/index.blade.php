@extends('admin_views.template.app')
@section('content')
  <div class="col-12 py-4 px-3">
    <div class="card mb-4 ">
      <div class="card-header pb-0">
        <h6>Tabel Kecamatan</h6>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="px-3">
          <a class="btn btn-primary mb-0 text-end" href="{{ route('kecamatan.create') }}">Buat</a>
        </div>
        <div class="table-responsive p-0">
          <table class="table align-items-center mb-0">
            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Gambar</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Kecamatan</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Deskripsi</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kode Pos</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Longitude</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Latitude</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">geojson</th>
                <th class="text-secondary opacity-7"></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($kecamatan as $data)
                <tr>
                  <td>
                    <div class="d-flex align-items-center justify-content-center">
                      <img src="{{ asset('storage/kecamatan/' . $data['image']) }}" class="avatar avatar-sm me-1"
                        alt="user1">
                    </div>
                  </td>
                  <td>
                    <h6 class="mb-0 text-sm text-center">{{ $data['nama_kecamatan'] }}</h6>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0 max-width-100 text-truncate d-inline-block">{{ $data['description'] }}</p>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <span class="text-secondary text-xs font-weight-bold">{{ $data['kode_pos'] }}</span>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <span class="text-secondary text-xs font-weight-bold">{{ $data['longitude'] }}</span>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold">{{ $data['latitude'] }}</span>
                  </td>
                  <td class="align-middle">
                    <a href="{{ asset('storage/geojson/' . $data['geojson']) }}"
                      class="text-info font-weight-bold text-xs" data-toggle="tooltip" target="_blank"
                      data-original-title="Lihat File geojson">
                      {{ $data['geojson'] }}
                    </a>
                  </td>
                  <td class="align-middle">
                    <a href="{{ route('kecamatan.edit', base64_encode($data['id'])) }}" class=" btn btn-warning px-3 py-2"
                      data-toggle="tooltip" data-original-title="Edit Kecamatan">
                      Edit
                    </a>
                    <a href="{{ route('kecamatan.delete', base64_encode($data['id'])) }}"
                      class=" btn btn-danger px-2 py-2" data-toggle="tooltip" data-original-title="hapus Kecamatan">
                      Hapus
                    </a>
                  </td>
                </tr>
              @endforeach

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
