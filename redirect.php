<?

include "database.php";

$redirect = $_GET["r"];

$connect = mysqli_connect($server, $user, $password, $database);

if (!$connect) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

$query = "SELECT link FROM links WHERE id = '".$redirect. "'";
$result = mysqli_query($connect, $query);
$link = mysqli_fetch_array($result)[0];
mysqli_close($connect);
header('Location: http://'.$link);