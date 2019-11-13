<?

include "database.php";
 

function intToAlphaBaseN($n,$baseArray) {
    $l=count($baseArray);
    $s = '';
    for ($i = 1; $n >= 0 && $i < 10; $i++) {
        $s =  $baseArray[($n % pow($l, $i) / pow($l, $i - 1))].$s;
        $n -= pow($l, $i);
    }
    return $s;
}

$alpha=array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z');
$r=rand(.0, 9999999.0);


$link = $_GET["link"];


$shortLink = intToAlphaBaseN($r, $alpha);

$connect = mysqli_connect($server, $user, $password, $database);

if (!$connect) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

$query = "SELECT CASE WHEN COUNT(1) > 0 THEN 1 ELSE 0 END AS link FROM links WHERE `link` = '". $link . "'";

$result = mysqli_query($connect, $query);

if (!(bool)((int)mysqli_fetch_array($result)[0])){
    $query = "INSERT INTO links (`id`, `link`) VALUES ('".$shortLink."','".$link."')";
    mysqli_query($connect, $query);
}else{
    $query = "SELECT id FROM links WHERE link = '". $link. "'";
    $result = mysqli_query($connect, $query);
    $shortLink = mysqli_fetch_array($result)[0];
}

mysqli_close($connect);

echo  $_SERVER['HTTP_HOST'] . "/r/" . $shortLink;