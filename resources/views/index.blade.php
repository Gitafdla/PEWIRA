    @extends('layouts.template')
    @section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css">
    <style>
        html, body{
            height: 1000px;
            width: 100%;
            margin: 0;
        }

        #map {
            height: calc(100vh - 56px);
            width: 100%;
            margin: 0;
        }
    </style>
    @endsection

    @section('content')
    <div id ="map"></div>

     <!-- Modal Create Point-->
<div class="modal fade" id="PointModal" tabindex="-1" aria-labelledby="PointModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="PointModalLabel"><i class="fa-solid fa-location-dot"></i> Create Point</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('store-point') }}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Komoditas</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Mineral & Batubara">
              </div>
              <div class="mb-3">
                <label for="description" class="form-label">Nomor WIUP</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
              </div>
              <div class="mb-3">
                <label for="geom" class="form-label">Geometry</label>
                <textarea class="form-control" id="geom_point" name="geom" rows="3" readonly></textarea>
              </div>
              <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" id="image_point"
                name="image"onchange="document.getElementById('preview-image-point').src = window.URL.createObjectURL(this.files[0])">
                <script>
                    document.getElementById().src = window.URL
                </script>
            </div>
            <div class="tabmb-3">
                <img src="" alt="Preview" id="preview-image-point"
                class="img-thumbnail" width="400">
            </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
      </div>
    </div>
  </div>

    <!-- Modal Create Polyline-->
    <div class="modal fade" id="PolylineModal" tabindex="-1" aria-labelledby="PolylineModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Create Polyline</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('store-polyline') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Komoditas</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Mineral & Batubara">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Nomor WIUP</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="geom" class="form-label">Geometry</label>
                            <textarea class="form-control" id="geom_polyline" name="geom" rows="3" readonly></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control" id="image_polyline" name="image"
                                onchange="document.getElementById('preview-image-polyline').src = window.URL.createObjectURL(this.files[0])">
                            <script>
                                document.getElementById().src = window.URL
                            </script>
                        </div>
                        <div class="tabmb-3">
                            <img src="" alt="Preview" id="preview-image-polyline" class="img-thumbnail"
                                width="400">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>

    </div>

     <!-- Modal Create Polygon-->
 <!-- Modal Create Polygon-->
 <div class="modal fade" id="PolygonModal" tabindex="-1" aria-labelledby="PolygonModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Create Polygon</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('store-polygon') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Komoditas</label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Mineral & Batubara">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Nomor WIUP</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="geom" class="form-label">Geometry</label>
                        <textarea class="form-control" id="geom_polygon" name="geom" rows="3" readonly></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image_polygon" name="image"
                            onchange="document.getElementById('preview-image-polygon').src = window.URL.createObjectURL(this.files[0])">
                        <script>
                            document.getElementById().src = window.URL
                        </script>
                    </div>
                    <div class="tabmb-3">
                        <img src="" alt="Preview" id="preview-image-polygon" class="img-thumbnail"
                            width="400">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>

</div>
    @endsection

   @section('script')
   <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>
   <script src="https://unpkg.com/terraformer@1.0.7/terraformer.js"></script>
   <script src="https://unpkg.com/terraformer-wkt-parser@1.1.2/terraformer-wkt-parser.js"></script>
    <script>
        //Map
        var map = L.map('map').setView([-1.6371293521627275, 102.44000114340317], 8);

       /* Tile Basemap */
       var basemap1 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Tiles &copy; Esri | <a href="WebGIS Tambang" target="_blank">Digita Fadelia Agni</a>'
        });
        var basemap2 = L.tileLayer(
            'https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{ z } / { y } / { x }', {
                attribution: 'Tiles &copy; Esri | <a href="WebGIS Tambang" target="_blank">Digita Fadelia Agni</a>'
            });
        var basemap3 = L.tileLayer(
            'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{ z } / { y } / { x }', {
                attribution: 'Tiles &copy; Esri | <a href="WebGIS Tambang" target="_blank">Digita Fadelia Agni</a>'
            });
        var basemap4 = L.tileLayer('https://tiles.stadiamaps.com/tiles/alidade_smooth_dark/{z}/{x}/{y}{r}.png', {
            attribution: 'Tiles &copy; Esri | <a href="WebGIS Tambang" target="_blank">Digita Fadelia Agni</a>'
        });
        basemap3.addTo(map);

        /* Control Layer */
        var baseMaps = {
            "OpenStreetMap": basemap1,
            "Esri World Street": basemap2,
            "Esri Imagery": basemap3,
            "Stadia Dark Mode": basemap4
        };
        var overlayMaps = {

        };
        L.control.layers(baseMaps, overlayMaps, {
            collapsed: false
        }).addTo(map);

        /* Scale Bar */
        L.control.scale({
            maxWidth: 150,
            position: 'bottomright'
        }).addTo(map);



       // Fungsi untuk mendapatkan warna random
function getRandomColor() {
    var letters = '0123456789ABCDEF';
    var color = '#';
    for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}

// Layer tambang
var tambangLayer = L.geoJson(null, {
    style: function(feature) {
        return {
            fillColor: 'brown',
            weight: 0.5,
            opacity: 1,
            color: 'white',
            dashArray: '',
            fillOpacity: 0.8
        };
    },
    onEachFeature: function(feature, layer) {
        var content = "Perusahaan: " + feature.properties.Nama + "<br>";
        layer.on({
            click: function(e) {
                layer.bindPopup(content).openPopup();
            },
            mouseover: function(e) {
                layer.setStyle({
                    weight: 3,
                    color: '#666',
                    dashArray: '',
                    fillOpacity: 0.2
                });
            },
            mouseout: function(e) {
                tambangLayer.resetStyle(layer);
            }
        });
    }
});

// Fetch GeoJSON data
fetch('/storage/geojson/tambang.geojson') // Path relatif untuk Laravel public directory
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok ' + response.statusText);
        }
        return response.json();
    })
    .then(data => {
        tambangLayer.addData(data); // Menambahkan data GeoJSON ke layer
        tambangLayer.addTo(map); // Menambahkan layer ke peta
    })
    .catch(error => {
        console.error('Error loading GeoJSON:', error);
        alert('Error loading GeoJSON: ' + error.message);
    });

    // Layer pertambangan
var pertambanganLayer = L.geoJson(null, {
    style: function(feature) {
        return {
            fillColor: 'brown',
            weight: 0.5,
            opacity: 1,
            color: 'white',
            dashArray: '',
            fillOpacity: 0.8
        };
    },
    onEachFeature: function(feature, layer) {
        var content = "Perusahaan: " + feature.properties.nama_usaha + "<br>";
        layer.on({
            click: function(e) {
                layer.bindPopup(content).openPopup();
            },
            mouseover: function(e) {
                layer.setStyle({
                    weight: 3,
                    color: '#666',
                    dashArray: '',
                    fillOpacity: 0.2
                });
            },
            mouseout: function(e) {
                pertambanganLayer.resetStyle(layer);
            }
        });
    }
});

// Fetch GeoJSON data
fetch('/storage/geojson/pertambangan.geojson') // Path relatif untuk Laravel public directory
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok ' + response.statusText);
        }
        return response.json();
    })
    .then(data => {
        pertambanganLayer.addData(data); // Menambahkan data GeoJSON ke layer
        pertambanganLayer.addTo(map); // Menambahkan layer ke peta
    })
    .catch(error => {
        console.error('Error loading GeoJSON:', error);
        alert('Error loading GeoJSON: ' + error.message);
    });

    // Layer sungai
var sungaiLayer = L.geoJson(null, {
    style: function(feature) {
        var randomColor = getRandomColor();
        return {
            fillColor: 'lightblue',
            weight: 2,
            opacity: 1,
            color: '',
            dashArray: '',
            fillOpacity: 0.8
        };
    },
    onEachFeature: function(feature, layer) {
        var content = "Sungai: " + feature.properties.KETERANGAN + "<br>";
        layer.on({
            click: function(e) {
                layer.bindPopup(content).openPopup();
            },
            mouseover: function(e) {
                layer.setStyle({
                    weight: 3,
                    color: '#666',
                    dashArray: '',
                    fillOpacity: 0.2
                });
            },
            mouseout: function(e) {
                sungaiLayer.resetStyle(layer);
            }
        });
    }
});

// Fetch GeoJSON data for sungai
fetch('/storage/geojson/sungai.geojson') // Path relatif untuk Laravel public directory
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok ' + response.statusText);
        }
        return response.json();
    })
    .then(data => {
        sungaiLayer.addData(data); // Menambahkan data GeoJSON ke layer
        sungaiLayer.addTo(map); // Menambahkan layer ke peta
    })
    .catch(error => {
        console.error('Error loading GeoJSON:', error);
        alert('Error loading GeoJSON: ' + error.message);
    });

    // Layer admin
var adminLayer = L.geoJson(null, {
    style: function(feature) {
        var randomColor = getRandomColor();
        return {
            fillColor: 'none',
            weight: 0.5,
            opacity: 1,
            color: 'white',
            dashArray: '',
            fillOpacity: 0.8
        };
    },
    onEachFeature: function(feature, layer) {
        var content = "Kabupaten: " + feature.properties.NAME_2 + "<br>";
        layer.on({
            click: function(e) {
                layer.bindPopup(content).openPopup();
            },
            mouseover: function(e) {
                layer.setStyle({
                    weight: 3,
                    color: '#666',
                    dashArray: '',
                    fillOpacity: 0.2
                });
            },
            mouseout: function(e) {
                adminLayer.resetStyle(layer);
            }
        });
    }
});

// Fetch GeoJSON data for admin
fetch('/storage/geojson/admin.geojson') // Path relatif untuk Laravel public directory
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok ' + response.statusText);
        }
        return response.json();
    })
    .then(data => {
        adminLayer.addData(data); // Menambahkan data GeoJSON ke layer
        adminLayer.addTo(map); // Menambahkan layer ke peta
    })
    .catch(error => {
        console.error('Error loading GeoJSON:', error);
        alert('Error loading GeoJSON: ' + error.message);
    });


/* Digitize Function */
var drawnItems = new L.FeatureGroup();
map.addLayer(drawnItems);

var drawControl = new L.Control.Draw({
	draw: {
		position: 'topleft',
		polyline: true,
		polygon: true,
		rectangle: true,
		circle: false,
		marker: true,
		circlemarker: false
	},
	edit: false
});

map.addControl(drawControl);

map.on('draw:created', function(e) {
	var type = e.layerType,
		layer = e.layer;

	console.log(type);

	var drawnJSONObject = layer.toGeoJSON();
	var objectGeometry = Terraformer.WKT.convert(drawnJSONObject.geometry);

	console.log(drawnJSONObject);
	console.log(objectGeometry);

	if (type === 'polyline') {
		 // Set value geometry to input geom
         $("#geom_polyline").val(objectGeometry);

        // Show modal
        $("#PolylineModal").modal('show');

	} else if (type === 'polygon' || type === 'rectangle') {
		// Set value geometry to input geom
        $("#geom_polygon").val(objectGeometry);

        // Show modal
        $("#PolygonModal").modal('show');

	} else if (type === 'marker') {
        // Set value geometry to input geom
        $("#geom_point").val(objectGeometry);

        // Show modal
        $("#PointModal").modal('show');
	} else {
		console.log('__undefined__');
	}

	drawnItems.addLayer(layer);
});
			/* GeoJSON Point */
            //menampilkan fitur-fitur GeoJSON di peta Leaflet.
			var point = L.geoJson(null, {
            onEachFeature: function(feature, layer) {
                var popupContent = "Nama: " + feature.properties.name + "<br>" +
                    "Deskripsi: " + feature.properties.description + "<br>" +
                    "Foto:<img src='{{ asset('storage/images/') }}/" + feature.properties.image +
                    "' class='img-thumbnail' alt='...'>" + "<br>" +

                    "<div class='d-flex flex-row mt-3'>" +
                    "<a href='{{ url('edit-point') }}/" + feature.properties.id +

                    "' class='btn btn-sm btn-warning me-2'><i class='fa-solid fa-edit'></i></a>" +

                    "<form action='{{ url('delete-point') }}/" + feature.properties.id + "' method='POST'>" +
                    '{{ csrf_field() }}' + '{{ method_field('DELETE') }}' +
                        // Cross-Site Request Forgery > menyisipkan input tersembunyi yang berisi token CSRF ke dalam form.
                    "<button type='submit' class='btn btn-danger' onclick='return confirm(`delete point?`)'><i class='fa-solid fa-trash-can'></i></button>"
                "</form>" +
                "</div>";

					layer.on({
						click: function (e) {
							point.bindPopup(popupContent);
						},
						mouseover: function (e) {
							point.bindTooltip(feature.properties.name);
						},
					});
				},
			});
            // menampilkan point pada peta
			$.getJSON("{{ route('api.points') }}", function (data) {
				point.addData(data);
				map.addLayer(point);
			});

             /* GeoJSON Polyline */
        var polyline = L.geoJson(null, {
            onEachFeature: function(feature, layer) {
                var popupContent = "Name:" + feature.properties.name + "<br>" +
                    "Description:" + feature.properties.description + "<br>" +
                    "Foto: <img src='{{ asset('storage/images/') }}/" + feature.properties.image +
                    "'class='img-thumbnail' alt=''>" + "<br>" +

                    "<div class='d-flex flex-row mt-3'>" +

                    "<a href='{{ url('edit-polyline') }}/" + feature.properties.id +
                    "' class='btn btn-sm btn-warning'><i class='fa-solid fa-edit'></i></a>" +


                    "<form action='{{ url('delete-polyline') }}/" + feature.properties.id + "'method='POST'>" +
                    '{{ csrf_field() }}' +
                    '{{ method_field('DELETE') }}' +

                    "<button type='submit' class='btn btn-danger' onclick='return confirm(Yakin Anda akan menghapus data ini?)'><i class='fa-solid fa-trash-can'></i></button>" +
                    "</form>";



                layer.on({
                    click: function(e) {
                        polyline.bindPopup(popupContent);
                    },
                    mouseover: function(e) {
                        polyline.bindTooltip(feature.properties.name);
                    },
                });
            },
        });
        // menampilkan polyline pada peta
        $.getJSON("{{ route('api.polylines') }}", function(data) {
            polyline.addData(data);
            map.addLayer(polyline);
        });
            // menampilkan Polyline pada peta
			$.getJSON("{{ route('api.polylines') }}", function (data) {
				Polyline.addData(data);
				map.addLayer(Polyline);
			});


                /* GeoJSON polygon */
			var polygon = L.geoJson(null, {
				onEachFeature: function (feature, layer) {
					var popupContent = "Name:" + feature.properties.name + "<br>" +
						"Description:" + feature.properties.description + "<br>" +
                        "Foto: <img src='{{ asset('storage/images/') }}/" + feature.properties.image + "' class='img-thumbnail' alt='...'>" + "<br>" +

                        "<div class='d-flex flex-row mt-3'>" +

                        "<a href='{{ url('edit-polygon') }}/" + feature.properties.id + "' class='btn btn-sm btn-warning'><i class='fa-solid fa-edit'></i></a>" +"<br>" +

                    "<form action='{{ url('delete-polygon') }}/" + feature.properties.id + "'method='POST'>" +
                    '{{ csrf_field() }}' +
                    '{{method_field('DELETE') }}' +

                    "<button type='submit' class='btn btn-danger' onclick='return confirm('Yakin Anda akan menghapus data ini?')'><i class='fa-solid fa-trash-can'></i></button>" +
                    "</form>"

                    "</div>"
                    ;

                        layer.on({
						click: function (e) {
							polygon.bindPopup(popupContent);
						},
						mouseover: function (e) {
							polygon.bindTooltip(feature.properties.name);
						},
					});
				},
			});
            // menampilkan polygon pada peta
			$.getJSON("{{ route('api.polygons') }}", function (data) {
				polygon.addData(data);
				map.addLayer(polygon);
			});

            // Layer control
            var wiupLayer = L.layerGroup([tambangLayer, pertambanganLayer]);

        var overlayMaps = {
            "WIUP": wiupLayer,
            "Tambang": point,
            "Sungai": sungaiLayer,
            "Administrasi": adminLayer
        };

        var layerControl = L.control.layers(null, overlayMaps).addTo(map);

         // Custom Control for Image
var customControl = L.Control.extend({
    onAdd: function(map) {
        var div = L.DomUtil.create('div', 'custom-control');
        div.innerHTML = '<img src="storage/image/pemira.png" alt="Small Image">';
        return div;
    }
});

map.addControl(new customControl({ position: 'bottomleft' }));


    </script>
    @endsection
