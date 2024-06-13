@extends('layouts.template')

@section('styles')
    <style>
        html,
        body {
            height: 100%;
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

    </div>
@endsection

@section('script')
    <script>
        //Map
        var map = L.map('map').setView([-1.5218665533342592, 102.92547412927202], 8);

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

        /* GeoJSON Point */
        var point = L.geoJson(null, {
            onEachFeature: function(feature, layer) {
                var popupContent = "Name:" + feature.properties.name + "<br>" +
                    "Description: " + feature.properties.description + "<br>" +
                    "Foto: <img src='{{ asset('storage/images/') }}/" + feature.properties.image +
                    "'class='img-thumbnail' alt=''>" + "<br>";

                layer.on({
                    click: function(e) {
                        point.bindPopup(popupContent);
                    },
                    mouseover: function(e) {
                        point.bindTooltip(feature.properties.name);
                    },
                });
            },
        });
        // menampilkan point pada peta
        $.getJSON("{{ route('api.points') }}", function(data) {
            point.addData(data);
            map.addLayer(point);
        });

        /* GeoJSON Polyline */
        var polyline = L.geoJson(null, {
            onEachFeature: function(feature, layer) {
                var popupContent = "Name:" + feature.properties.name + "<br>" +
                    "Description:" + feature.properties.description + "<br>" +
                    "Foto: <img src='{{ asset('storage/images/') }}/" + feature.properties.image +
                    "'class='img-thumbnail' alt=''>" + "<br>";



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
        /* GeoJSON polygon */
        var polygon = L.geoJson(null, {
            onEachFeature: function(feature, layer) {
                var popupContent = "Name:" + feature.properties.name + "<br>" +
                    "Description:" + feature.properties.description + "<br>" +
                    "Foto: <img src='{{ asset('storage/images/') }}/" + feature.properties.image +
                    "'class='img-thumbnail' alt=''>" + "<br>";


                ;

                layer.on({
                    click: function(e) {
                        polygon.bindPopup(popupContent);
                    },
                    mouseover: function(e) {
                        polygon.bindTooltip(feature.properties.name);
                    },
                });
            },
        });
        // menampilkan polygon pada peta
        $.getJSON("{{ route('api.polygons') }}", function(data) {
            polygon.addData(data);
            map.addLayer(polygon);
        });

        // layer control
        var wiupLayer = L.layerGroup([tambangLayer, pertambanganLayer]);

        var overlayMaps = {
            "WIUP": wiupLayer,
            "Tambang": point,
            "Sungai": sungaiLayer,
            "Administrasi": adminLayer
        };

        var layerControl = L.control.layers(null, overlayMaps).addTo(map);
    </script>
@endsection
