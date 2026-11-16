<?php
$conn = new mysqli("localhost", "root", "", "lat9");

if ($conn->connect_error) {
    die("Koneksi gagal");
}

$sql = "SELECT * FROM kantor_kec";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Web GIS</title>

    <link rel="stylesheet"
    href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <link rel="stylesheet
    "href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/gh/anshori/Leaflet.awesome-markers@v2.0.2/dist/leaflet.awesome-markers.css">

    <style>
    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        font-family: Arial, sans-serif;
        background: #f1f5f9;
    }

    .header {
        background: #166534;
        color: white;
        padding: 20px;
        text-align: center;
    }

    .header h1 {
        margin: 0;
        font-size: 26px;
    }

    .header p {
        margin: 8px 0 0;
        font-size: 14px;
    }

    .map-container {
        padding: 20px;
    }

    #map {
        width: 100%;
        height: 600px;
        border-radius: 12px;
        border: 1px solid #d1d5db;
    }

    .footer {
        text-align: center;
        padding: 15px;
        color: #64748b;
        font-size: 13px;} 
    
    .legend-card {
    background: white;
    padding: 10px 14px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.15);
    font-size: 12px;}
    </style>
</head>

<body>

<div id="map"></div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js">
</script>

<script src="https://cdn.jsdelivr.net/gh/anshori/Leaflet.awesome-markers@v2.0.2/dist/leaflet.awesome-markers.js">
</script>

<script>

// Membuat peta
var map = L.map('map').setView(
    [-7.4832133, 109.140438], 10
);

// Membuat basemap

 // Basemap OpenStreetMap
var osm = L.tileLayer(
    'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
    {
        attribution: '&copy; OpenStreetMap contributors'
    }
);

// Basemap Esri Satellite
var satellite = L.tileLayer(
    'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}',
    {
        attribution: 'Tiles &copy; Esri'
    }
);

// Basemap awal
osm.addTo(map);


// Membuat layer marker
var markerLayer = L.layerGroup();

// Membuat ikon kantor kecamatan
var iconKantor = L.AwesomeMarkers.icon({
    icon: "building",
    prefix: "fa",
    extraClasses: "fa-solid",
    markerColor: "green",
    iconColor: "white"
});

// Mengambil data dari database
<?php
while ($row = $result->fetch_assoc()) {
?>

var marker = L.marker([
    <?php echo $row['Latitude']; ?>,
    <?php echo $row['Longitude']; ?>
], {
    icon: iconKantor
});

marker.bindTooltip(
    <?php
    echo json_encode(
        "Kecamatan: " . $row['Kecamatan'] .
        "\nLatitude: " . $row['Latitude'] .
        "\nLongitude: " . $row['Longitude']
    );
    ?>,
    {
        direction: 'top',
        sticky: true
    }
);

marker.addTo(markerLayer);

<?php
}
?>

// Menampilkan marker
markerLayer.addTo(map);

var baseMaps = {
    "OpenStreetMap": osm,
    "Satellite": satellite,
};

var overlayMaps = {
    "Kantor Kecamatan": markerLayer
};

L.control.layers(
    baseMaps,
    overlayMaps
).addTo(map);

var legend = L.control({ position: "bottomright" });

legend.onAdd = function () {
    var div = L.DomUtil.create("div", "legend-card");

    div.innerHTML =
        '<strong>Legenda</strong><br>' +
        '<i class="fa-solid fa-building" ' +
        'style="color:#166534; margin-right:6px;"></i>' +
        'Kantor Kecamatan';

    return div;
};

legend.addTo(map);

L.control.scale().addTo(map);

var legend = L.control({ position: 'bottomright' });



</script>


</body>
</html>