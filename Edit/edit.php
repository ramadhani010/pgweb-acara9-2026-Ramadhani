
<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "lat9";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $id = $_GET['id'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $kecamatan = $_POST['kecamatan'];
        $longitude = $_POST['longitude'];
        $latitude = $_POST['latitude'];
        $jumlah_pns = $_POST['jumlah_pns'];
        $alamat = $_POST['alamat'];

        $sql = "UPDATE kantor_kec SET
        Kecamatan='$kecamatan',
        Longitude=$longitude,
        Latitude=$latitude,
        `Jumlah PNS`=$jumlah_pns,
        Alamat='$alamat'
        WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            header("Location: ../index.php");
            exit;
        } else {
            echo "Error: " . $conn->error;
        }
    }

    $sql = "SELECT * FROM kantor_kec WHERE id='$id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $kecamatan = $row['Kecamatan'];
    $longitude = $row['Longitude'];
    $latitude = $row['Latitude'];
    $jumlah_pns = $row['Jumlah PNS'];
    $alamat = $row['Alamat'];
?>

<h1>Edit Kantor Kecamatan</h1>

<form method="POST" action="">
    <input type="hidden" name="id" value="<?php echo $id; ?>">

    Kecamatan:
    <input type="text" name="kecamatan"
    value="<?php echo $kecamatan; ?>"><br><br>

    Longitude:
    <input type="text" name="longitude"
    value="<?php echo $longitude; ?>"><br><br>

    Latitude:
    <input type="text" name="latitude"
    value="<?php echo $latitude; ?>"><br><br>

    Jumlah PNS:
    <input type="text" name="jumlah_pns"
    value="<?php echo $jumlah_pns; ?>"><br><br>

    Alamat:
    <input type="text" name="alamat"
    value="<?php echo $alamat; ?>"><br><br>

    <button type="submit">Update</button>
</form>

<?php
    $conn->close();
?>
