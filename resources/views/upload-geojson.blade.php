<!DOCTYPE html>
<html>

<head>
  <title>Upload GeoJSON</title>
</head>

<body>
  <h2>Upload File GeoJSON Kecamatan</h2>
  <form action="{{ route('upload.geojson') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="geojson" accept=".geojson" required>
    <button type="submit">Upload & Simpan</button>
  </form>
</body>

</html>
