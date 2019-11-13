<?
include "database.php";

$id = $_GET["name"];

$connect = mysqli_connect($server, $user, $password, $database);

if (!$connect) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

$query = "DELETE FROM `links` WHERE `links`.`id_links` = ".$id;
$result = mysqli_query($connect, $query);
$query = "SELECT * FROM links";
$result = mysqli_query($connect, $query);
mysqli_close($connect);

?>
<tr>
        <td>Сокращенная ссылка</td>
        <td>Ссылка</td>
        <td>Удалить</td>
    </tr>
    <? while($a = mysqli_fetch_array($result)){?>
    <tr>
        <td><? echo $_SERVER['HTTP_HOST'] . "/r/".$a["id"] ?></td>
        <td width="400"><? echo $a["link"] ?></td>
        <td><button type="button"><? echo $a["id_links"]?></button></td>
    </tr>
    <?}?>