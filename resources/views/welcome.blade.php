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
      width: 400px;
    }
  </style>
</head>

<body>
  <div id="map"></div>
  <script src="https://unpkg.com/leaflet.latlng-graticule@0.2.1/L.LatLngGraticule.min.js"></script>

  {{-- <script>
    var map = L.map('map').setView([-3.9994301448919662, 122.51334926450383], 13);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 11,
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

    // nambo
    fetch("{{ asset('storage/geojson/nambo.geojson') }}")
      .then(response => response.json())
      .then(data => {
        const geoJsonLayer = L.geoJSON(data, {
          onEachFeature: function(feature, layer) {
            if (feature.properties && feature.properties.name) {
              layer.bindPopup(feature.properties.name);
            }
          },
          style: function(feature) {
            return {
              color: feature.properties.color || '#3388ff',
              weight: 2,
              opacity: 1,
              fillOpacity: 0.5
            };
          }
        }).addTo(map)
        map.fitBounds(geoJsonLayer.getBounds());
      })
      .catch(error => console.error('Error loading GeoJSON:', error));

    // abeli
    fetch("{{ asset('storage/geojson/abeli.geojson') }}")
      .then(response => response.json())
      .then(data => {
        const geoJsonLayer = L.geoJSON(data, {
          onEachFeature: function(feature, layer) {
            if (feature.properties && feature.properties.name) {
              layer.bindPopup(feature.properties.name);
            }
          },
          style: function(feature) {
            return {
              color: feature.properties.color || '#33ff',
              weight: 2,
              opacity: 1,
              fillOpacity: 0.5
            };
          }
        }).addTo(map)
        map.fitBounds(geoJsonLayer.getBounds());
      })
      .catch(error => console.error('Error loading GeoJSON:', error));

    // poasia
    fetch("{{ asset('storage/geojson/poasia.geojson') }}")
      .then(response => response.json())
      .then(data => {
        const geoJsonLayer = L.geoJSON(data, {
          onEachFeature: function(feature, layer) {
            if (feature.properties && feature.properties.name) {
              layer.bindPopup(feature.properties.name);
            }
          },
          style: function(feature) {
            return {
              color: feature.properties.color || '#3ff',
              weight: 2,
              opacity: 1,
              fillOpacity: 0.5
            };
          }
        }).addTo(map)
        map.fitBounds(geoJsonLayer.getBounds());
      })
      .catch(error => console.error('Error loading GeoJSON:', error));

    // kendari barat
    fetch("{{ asset('storage/geojson/kendari_barat.geojson') }}")
      .then(response => response.json())
      .then(data => {
        const geoJsonLayer = L.geoJSON(data, {
          onEachFeature: function(feature, layer) {
            if (feature.properties && feature.properties.name) {
              layer.bindPopup(feature.properties.name);
            }
          },
          style: function(feature) {
            return {
              color: feature.properties.color || '#3DAF4f',
              weight: 2,
              opacity: 1,
              fillOpacity: 0.5
            };
          }
        }).addTo(map)
        map.fitBounds(geoJsonLayer.getBounds());
      })
      .catch(error => console.error('Error loading GeoJSON:', error));

    // kambu
    fetch("{{ asset('storage/geojson/kambu.geojson') }}")
      .then(response => response.json())
      .then(data => {
        const geoJsonLayer = L.geoJSON(data, {
          onEachFeature: function(feature, layer) {
            if (feature.properties && feature.properties.name) {
              layer.bindPopup(feature.properties.name);
            }
          },
          style: function(feature) {
            return {
              color: feature.properties.color || '#8DAF4f',
              weight: 2,
              opacity: 1,
              fillOpacity: 0.5
            };
          }
        }).addTo(map)
        map.fitBounds(geoJsonLayer.getBounds());
      })
      .catch(error => console.error('Error loading GeoJSON:', error));

    // kadia
    fetch("{{ asset('storage/geojson/kadia.geojson') }}")
      .then(response => response.json())
      .then(data => {
        const geoJsonLayer = L.geoJSON(data, {
          onEachFeature: function(feature, layer) {
            if (feature.properties && feature.properties.name) {
              layer.bindPopup(feature.properties.name);
            }
          },
          style: function(feature) {
            return {
              color: feature.properties.color || '#3DAF8f',
              weight: 2,
              opacity: 1,
              fillOpacity: 0.5
            };
          }
        }).addTo(map)
        map.fitBounds(geoJsonLayer.getBounds());
      })
      .catch(error => console.error('Error loading GeoJSON:', error));
    // kendari
    fetch("{{ asset('storage/geojson/kendari.geojson') }}")
      .then(response => response.json())
      .then(data => {
        const geoJsonLayer = L.geoJSON(data, {
          onEachFeature: function(feature, layer) {
            console.log(feature.properties.wadmkc);
            if (feature.properties) {
              layer.bindPopup(`Kecamatan ${feature.properties.wadmkc}`);
            }
          },
          style: function(feature) {
            return {
              color: feature.properties.color || '#3HDAF8f',
              weight: 2,
              opacity: 1,
              fillOpacity: 0.5
            };
          }
        }).addTo(map)
        map.fitBounds(geoJsonLayer.getBounds());
      })
      .catch(error => console.error('Error loading GeoJSON:', error));
    // baruga
    fetch("{{ asset('storage/geojson/baruga.geojson') }}")
      .then(response => response.json())
      .then(data => {
        const geoJsonLayer = L.geoJSON(data, {
          onEachFeature: function(feature, layer) {
            console.log(feature.properties.wadmkc);
            if (feature.properties) {
              layer.bindPopup(`Kecamatan ${feature.properties.wadmkc}`);
            }
          },
          style: function(feature) {
            return {
              color: feature.properties.color || '#3HDAF8f',
              weight: 2,
              opacity: 1,
              fillOpacity: 0.5
            };
          }
        }).addTo(map)
        map.fitBounds(geoJsonLayer.getBounds());
      })
      .catch(error => console.error('Error loading GeoJSON:', error));
    // mandonga
    fetch("{{ asset('storage/geojson/mandonga.geojson') }}")
      .then(response => response.json())
      .then(data => {
        const geoJsonLayer = L.geoJSON(data, {
          onEachFeature: function(feature, layer) {
            console.log(feature.properties.wadmkc);
            if (feature.properties) {
              layer.bindPopup(`Kecamatan ${feature.properties.wadmkc}`);
            }
          },
          style: function(feature) {
            return {
              color: feature.properties.color || '#3HDAF8f',
              weight: 2,
              opacity: 1,
              fillOpacity: 0.5
            };
          }
        }).addTo(map)
        map.fitBounds(geoJsonLayer.getBounds());
      })
      .catch(error => console.error('Error loading GeoJSON:', error));
    // wua-wua
    fetch("{{ asset('storage/geojson/wua_wua.geojson') }}")
      .then(response => response.json())
      .then(data => {
        const geoJsonLayer = L.geoJSON(data, {
          onEachFeature: function(feature, layer) {
            console.log(feature.properties.wadmkc);
            if (feature.properties) {
              layer.bindPopup(`Kecamatan ${feature.properties.wadmkc}`);
            }
          },
          style: function(feature) {
            return {
              color: feature.properties.color || '#3HDAF8f',
              weight: 2,
              opacity: 1,
              fillOpacity: 0.5
            };
          }
        }).addTo(map)
        map.fitBounds(geoJsonLayer.getBounds());
      })
      .catch(error => console.error('Error loading GeoJSON:', error));
    // puuwatu
    fetch("{{ asset('storage/geojson/puuwatu.geojson') }}")
      .then(response => response.json())
      .then(data => {
        const geoJsonLayer = L.geoJSON(data, {
          onEachFeature: function(feature, layer) {
            console.log(feature.properties.wadmkc);
            if (feature.properties) {
              layer.bindPopup(`Kecamatan ${feature.properties.wadmkc}`);
            }
          },
          style: function(feature) {
            return {
              color: feature.properties.color || '#3HDAF8f',
              weight: 2,
              opacity: 1,
              fillOpacity: 0.5
            };
          }
        }).addTo(map)
        map.fitBounds(geoJsonLayer.getBounds());
      })
      .catch(error => console.error('Error loading GeoJSON:', error));
  </script> --}}
  {{-- <script>
    var map = L.map('map', {
      minZoom: 12,
      maxZoom: 16,
      //   zoomControl: false, // Optional: hide zoom controls
      dragging: true,
      //   scrollWheelZoom: false // Optional: disable scroll zoom
    }).setView([-3.9976, 122.5120], 13); // Center on Kendari

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 16,
      minZoom: 12
    }).addTo(map);

    // Set bounds to lock the view to the city's region
    var bounds = L.latLngBounds(
      [-4.05, 122.45], // Southwest corner
      [-3.95, 122.58] // Northeast corner
    );

    map.setMaxBounds(bounds);
    map.on('drag', function() {
      map.panInsideBounds(bounds, {
        animate: false
      });
    });


    // nambo
    fetch("{{ asset('storage/geojson/nambo.geojson') }}")
      .then(response => response.json())
      .then(data => {
        const geoJsonLayer = L.geoJSON(data, {
          onEachFeature: function(feature, layer) {
            if (feature.properties && feature.properties.name) {
              layer.bindPopup(feature.properties.name);
            }
          },
          style: function(feature) {
            return {
              color: feature.properties.color || '#3388ff',
              weight: 2,
              opacity: 1,
              fillOpacity: 0.5
            };
          }
        }).addTo(map)
        map.fitBounds(geoJsonLayer.getBounds());
      })
      .catch(error => console.error('Error loading GeoJSON:', error));

    // abeli
    fetch("{{ asset('storage/geojson/abeli.geojson') }}")
      .then(response => response.json())
      .then(data => {
        const geoJsonLayer = L.geoJSON(data, {
          onEachFeature: function(feature, layer) {
            if (feature.properties && feature.properties.name) {
              layer.bindPopup(feature.properties.name);
            }
          },
          style: function(feature) {
            return {
              color: feature.properties.color || '#33ff',
              weight: 2,
              opacity: 1,
              fillOpacity: 0.5
            };
          }
        }).addTo(map)
        map.fitBounds(geoJsonLayer.getBounds());
      })
      .catch(error => console.error('Error loading GeoJSON:', error));

    // poasia
    fetch("{{ asset('storage/geojson/poasia.geojson') }}")
      .then(response => response.json())
      .then(data => {
        const geoJsonLayer = L.geoJSON(data, {
          onEachFeature: function(feature, layer) {
            if (feature.properties && feature.properties.name) {
              layer.bindPopup(feature.properties.name);
            }
          },
          style: function(feature) {
            return {
              color: feature.properties.color || '#3ff',
              weight: 2,
              opacity: 1,
              fillOpacity: 0.5
            };
          }
        }).addTo(map)
        map.fitBounds(geoJsonLayer.getBounds());
      })
      .catch(error => console.error('Error loading GeoJSON:', error));

    // kendari barat
    fetch("{{ asset('storage/geojson/kendari_barat.geojson') }}")
      .then(response => response.json())
      .then(data => {
        const geoJsonLayer = L.geoJSON(data, {
          onEachFeature: function(feature, layer) {
            if (feature.properties && feature.properties.name) {
              layer.bindPopup(feature.properties.name);
            }
          },
          style: function(feature) {
            return {
              color: feature.properties.color || '#3DAF4f',
              weight: 2,
              opacity: 1,
              fillOpacity: 0.5
            };
          }
        }).addTo(map)
        map.fitBounds(geoJsonLayer.getBounds());
      })
      .catch(error => console.error('Error loading GeoJSON:', error));

    // kambu
    fetch("{{ asset('storage/geojson/kambu.geojson') }}")
      .then(response => response.json())
      .then(data => {
        const geoJsonLayer = L.geoJSON(data, {
          onEachFeature: function(feature, layer) {
            if (feature.properties && feature.properties.name) {
              layer.bindPopup(feature.properties.name);
            }
          },
          style: function(feature) {
            return {
              color: feature.properties.color || '#8DAF4f',
              weight: 2,
              opacity: 1,
              fillOpacity: 0.5
            };
          }
        }).addTo(map)
        map.fitBounds(geoJsonLayer.getBounds());
      })
      .catch(error => console.error('Error loading GeoJSON:', error));

    // kadia
    fetch("{{ asset('storage/geojson/kadia.geojson') }}")
      .then(response => response.json())
      .then(data => {
        const geoJsonLayer = L.geoJSON(data, {
          onEachFeature: function(feature, layer) {
            if (feature.properties && feature.properties.name) {
              layer.bindPopup(feature.properties.name);
            }
          },
          style: function(feature) {
            return {
              color: feature.properties.color || '#3DAF8f',
              weight: 2,
              opacity: 1,
              fillOpacity: 0.5
            };
          }
        }).addTo(map)
        map.fitBounds(geoJsonLayer.getBounds());
      })
      .catch(error => console.error('Error loading GeoJSON:', error));
    // kendari
    fetch("{{ asset('storage/geojson/kendari.geojson') }}")
      .then(response => response.json())
      .then(data => {
        const geoJsonLayer = L.geoJSON(data, {
          onEachFeature: function(feature, layer) {
            console.log(feature.properties.wadmkc);
            if (feature.properties) {
              layer.bindPopup(`Kecamatan ${feature.properties.wadmkc}`);
            }
          },
          style: function(feature) {
            return {
              color: feature.properties.color || '#3HDAF8f',
              weight: 2,
              opacity: 1,
              fillOpacity: 0.5
            };
          }
        }).addTo(map)
        map.fitBounds(geoJsonLayer.getBounds());
      })
      .catch(error => console.error('Error loading GeoJSON:', error));
    // baruga
    fetch("{{ asset('storage/geojson/baruga.geojson') }}")
      .then(response => response.json())
      .then(data => {
        const geoJsonLayer = L.geoJSON(data, {
          onEachFeature: function(feature, layer) {
            console.log(feature.properties.wadmkc);
            if (feature.properties) {
              layer.bindPopup(`Kecamatan ${feature.properties.wadmkc}`);
            }
          },
          style: function(feature) {
            return {
              color: feature.properties.color || '#3HDAF8f',
              weight: 2,
              opacity: 1,
              fillOpacity: 0.5
            };
          }
        }).addTo(map)
        map.fitBounds(geoJsonLayer.getBounds());
      })
      .catch(error => console.error('Error loading GeoJSON:', error));
    // mandonga
    fetch("{{ asset('storage/geojson/mandonga.geojson') }}")
      .then(response => response.json())
      .then(data => {
        const geoJsonLayer = L.geoJSON(data, {
          onEachFeature: function(feature, layer) {
            console.log(feature.properties.wadmkc);
            if (feature.properties) {
              layer.bindPopup(`Kecamatan ${feature.properties.wadmkc}`);
            }
          },
          style: function(feature) {
            return {
              color: feature.properties.color || '#3HDAF8f',
              weight: 2,
              opacity: 1,
              fillOpacity: 0.5
            };
          }
        }).addTo(map)
        map.fitBounds(geoJsonLayer.getBounds());
      })
      .catch(error => console.error('Error loading GeoJSON:', error));
    // wua-wua
    fetch("{{ asset('storage/geojson/wua_wua.geojson') }}")
      .then(response => response.json())
      .then(data => {
        const geoJsonLayer = L.geoJSON(data, {
          onEachFeature: function(feature, layer) {
            console.log(feature.properties.wadmkc);
            if (feature.properties) {
              layer.bindPopup(`Kecamatan ${feature.properties.wadmkc}`);
            }
          },
          style: function(feature) {
            return {
              color: feature.properties.color || '#3HDAF8f',
              weight: 2,
              opacity: 1,
              fillOpacity: 0.5
            };
          }
        }).addTo(map)
        map.fitBounds(geoJsonLayer.getBounds());
      })
      .catch(error => console.error('Error loading GeoJSON:', error));
    // puuwatu
    fetch("{{ asset('storage/geojson/puuwatu.geojson') }}")
      .then(response => response.json())
      .then(data => {
        const geoJsonLayer = L.geoJSON(data, {
          onEachFeature: function(feature, layer) {
            console.log(feature.properties.wadmkc);
            if (feature.properties) {
              layer.bindPopup(`Kecamatan ${feature.properties.wadmkc}`);
            }
          },
          style: function(feature) {
            return {
              color: feature.properties.color || '#3HDAF8f',
              weight: 2,
              opacity: 1,
              fillOpacity: 0.5
            };
          }
        }).addTo(map)
        map.fitBounds(geoJsonLayer.getBounds());
      })
      .catch(error => console.error('Error loading GeoJSON:', error));
  </script> --}}

  {{-- <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script> --}}

  <script>
    var map = L.map('map').setView([-3.992242014553726, 122.53258165448392], 13);
    map.createPane('labels');
    map.getPane('labels').style.zIndex = 650;

    var positron = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_nolabels/{z}/{x}/{y}.png', {
    }).addTo(map);
    var positronLabels = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_only_labels/{z}/{x}/{y}.png', {
      pane: 'labels'
    }).addTo(map);
    L.control.scale({
      position: 'bottomleft', // atau 'topright', 'topleft', dll
      metric: true, // tampilkan km/m
      imperial: false, // sembunyikan mil/feet
      maxWidth: 200 // lebar maksimum skala (px)
    }).addTo(map);




    // // Load topeng hitam untuk menyembunyikan luar kota
    // fetch("{{ asset('storage/geojson/kendari_masked_inverse.json') }}")
    //   .then(res => res.json())
    //   .then(mask => {
    //     L.geoJSON(mask, {
    //       style: {
    //         fillColor: "#FFF", // Warna luar kota
    //         fillOpacity: 1,
    //         color: "#FFF",
    //         weight: 1,
    //         opacity: 0.7
    //       }
    //     }).addTo(map);
    //   });

    // Load kota Kendari di atasnya
    fetch("{{ asset('storage/geojson/kota_kendari.json') }}")
      .then(res => res.json())
      .then(kendari => {
        const layer = L.geoJSON(kendari, {
          style: {
            fill: false,
            weight: 1,
            color: "#FF0000", // Warna garis luar kota
            opacity: 1
          }
        }).addTo(map);
        map.fitBounds(layer.getBounds());
      });
    fetch("{{ asset('storage/geojson/abeli.geojson') }}")
      .then(res => res.json())
      .then(kendari => {
        const layer = L.geoJSON(kendari, {
          style: {
            fill: false,
            weight: 1,
            color: "#FF0000", // Warna garis luar kota
            opacity: 1
          }
        }).addTo(map);
      });



    L.latlngGraticule({
      showLabel: true, // Tampilkan label lintang dan bujur
      color: '#FF2344', // Warna garis grid
      weight: 2, // Ketebalan garis
      opacity: 1,
      font: "12px Arial",
      zoomInterval: [{
          start: 2,
          end: 5,
          interval: 10
        },
        {
          start: 6,
          end: 7,
          interval: 5
        },
        {
          start: 8,
          end: 10,
          interval: 1
        },
        {
          start: 11,
          end: 13,
          interval: 0.5
        },
        {
          start: 14,
          end: 20,
          interval: 0.1
        }
      ]
    }).addTo(map);
  </script>


</body>

</html>
