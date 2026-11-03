<?php
$servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "lat9";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }

    $sql = "SELECT * FROM kantor_kec";
    $result = $conn->query($sql);

    echo "<h1>Kantor Kecamatan Banyumas</h1>";    
    // Input dari modul sebelumnya
    echo "<a href='input/index.html'>Input</a>";

    // Tabel dari modul Delete dan Edit
    if ($result->num_rows > 0) {

        echo "<table border='1px'><tr>
        <th>Kecamatan</th>
        <th>Longitude</th>
        <th>Latitude</th>
        <th>Jumlah PNS</th>
        <th>Alamat</th>
        <th colspan='2'>Aksi</th>";

        while($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["Kecamatan"]."</td>".
            "<td>".$row["Longitude"]."</td>".
            "<td>".$row["Latitude"]."</td>".
            "<td>".$row["Jumlah PNS"]."</td>".
            "<td align='right'>".$row["Alamat"]."</td>".
            "<td><a href=delete.php?id=".$row["id"].">hapus</a></td>".
            "<td><a href=edit/index.php?id=".$row["id"].">edit</a></td>".
            "</tr>";
        }

        echo "</table>";

    } else {
        echo "0 results";
    }
?>