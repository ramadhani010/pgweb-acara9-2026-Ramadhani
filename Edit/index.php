<?php
    $id = $_POST['id'];
    $kecamatan = $_POST['kecamatan'];
    $longitude = $_POST['longitude'];
    $latitude = $_POST['latitude'];
    $jumlah_pns = $_POST['jumlah_pns'];
    $alamat = $_POST['alamat'];

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