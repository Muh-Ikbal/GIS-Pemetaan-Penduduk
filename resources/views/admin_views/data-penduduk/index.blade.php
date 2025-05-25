@extends('admin_views.template.app')
@section('content')
  <div class="col-12 py-4 px-3">
    <div class="card mb-4 ">
      <div class="card-header pb-0">
        <h6>Tabel Data Kependudukan</h6>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="px-3">
          <a class="btn btn-primary mb-0 text-end" href="{{ route('data-penduduk.create') }}">Buat</a>
        </div>
        <div class="table-responsive p-0">
          <table class="table align-items-center mb-0">
            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kecamatan</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kepadatan Penduduk</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jumlah Penduduk</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jumlah
                  Laki-Laki</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jumlah
                  Perempuan</th>

                <th class="text-secondary opacity-7"></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($dataPenduduk as $tahun => $penduduk)
                <tr>
                  <td colspan="6">
                    <h3 class="text-center">{{ $tahun }}</h3>
                  </td>
                </tr>
                @foreach ($penduduk as $data)
                  <tr>
                    <td>
                      <h6 class="mb-0 text-sm text-center">{{ $data->kecamatan->nama_kecamatan }}</h6>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0">{{ $data['kepadatan_penduduk'] }}</p>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="text-secondary text-xs font-weight-bold">{{ $data['jumlah_penduduk'] }}</span>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="text-secondary text-xs font-weight-bold">{{ $data['jumlah_laki_laki'] }}</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">{{ $data['jumlah_perempuan'] }}</span>
                    </td>
                    <td class="align-middle">
                      <a href="{{ route('data-penduduk.edit', base64_encode($data['id'])) }}"
                        class=" btn btn-warning px-3 py-2" data-toggle="tooltip" data-original-title="Edit Data Penduduk">
                        Edit
                      </a>
                      <a href="{{ route('data-penduduk.delete', base64_encode($data['id'])) }}"
                        class=" btn btn-danger px-2 py-2" data-toggle="tooltip"
                        data-original-title="hapus data penduduk">
                        Hapus
                      </a>
                    </td>
                  </tr>
                @endforeach
              @endforeach

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
