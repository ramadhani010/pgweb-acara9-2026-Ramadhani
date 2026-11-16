<?php
    $id = $_GET['id'];

    $sql = "SELECT * FROM kantor_kec WHERE id='$id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $kecamatan = $row['Kecamatan'];
    $longitude = $row['Longitude'];
    $latitude = $row['Latitude'];
    $jumlah_pns = $row['Jumlah PNS'];
    $alamat = $row['Alamat'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "lat9";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE kantor_kec SET
    Kecamatan='$kecamatan',
    Longitude=$longitude,
    Latitude=$latitude,
    `Jumlah PNS`=$jumlah_pns,
    Alamat='$alamat'
    WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Record edited successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();

    header("Location: ../index.php");
?>