<?
if ($_GET["login"]){
    include "database.php";

$login = $_GET["login"];
$pass = $_GET["pass"];

$connect = mysqli_connect($server, $user, $password, $database);

if (!$connect) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

$query = "SELECT * FROM admin WHERE login = '". $login."' AND password = '". $pass."'";
$result = mysqli_query($connect, $query);
        mysqli_close($connect);
    $result = mysqli_fetch_array($result);
    if ($result){
        include "admin.php";
    }else{
        header('Location: /');
    }

}else{
        header('Location: /');
    }