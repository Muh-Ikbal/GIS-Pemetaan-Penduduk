<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
  <title>Document</title>
  <style>
    #map {
      height: 400px;
    }
  </style>
</head>

<body>
  <div id="map"></div>
  <script>
    var map = L.map('map').setView([-3.9994301448919662, 122.51334926450383], 13);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);
    // Kios Asma
    var marker = L.marker([-4.016375152719851, 122.5851594265173]).addTo(map);
    marker.bindPopup("<b>Kios Asma</b>").closePopup();
    // PT. CITRA TAMA JAYA INDO
    var marker = L.marker([-3.989846244211088, 122.51013608697595]).addTo(map);
    marker.bindPopup("<b>PT. ANOVA GROUB</b>").closePopup();
    // PT. CITRA TAMA JAYA INDO
    var marker = L.marker([-3.970418646633375, 122.50673650722825]).addTo(map);
    marker.bindPopup("<b>RESKI LAIFASTO PT</b>").closePopup();
  </script>
</body>

</html>
