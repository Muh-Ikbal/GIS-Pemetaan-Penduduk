<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Create Kecamatan</title>
</head>

<body>
  <h2>Input Kecamatan</h2>
  @if ($errors->any())
    <div style="color:red">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  <form action="{{ route('kecamatan.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <label for="nama_kecamatan">Nama Kecamatan:</label>
    <input type="text" id="nama_kecamatan" name="nama_kecamatan" required>
    <br><br>

    <label for="kode_pos">Kode Pos:</label>
    <input type="text" id="kode_pos" name="kode_pos" required>
    <br><br>

    <label for="description">Deskripsi:</label>
    <textarea id="description" name="description"></textarea>
    <br><br>

    <label for="geojson">Upload GeoJSON:</label>
    <input type="file" id="geojson" name="geojson" accept=".geojson,.json" required>
    <br><br>

    <button type="submit">Simpan</button>
  </form>
</body>

</html>
