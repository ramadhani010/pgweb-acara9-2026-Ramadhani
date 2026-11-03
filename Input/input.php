```php
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

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

        $sql = "INSERT INTO kantor_kec
        (Kecamatan, Longitude, Latitude, `Jumlah PNS`, Alamat)
        VALUES
        ('$kecamatan', $longitude, $latitude, $jumlah_pns, '$alamat')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();

        header("Location: ../index.php");
    }
?>