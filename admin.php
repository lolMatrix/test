<?
include "database.php";

$connect = mysqli_connect($server, $user, $password, $database);

if (!$connect) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

$query = "SELECT * FROM links";
$result = mysqli_query($connect, $query);
mysqli_close($connect);
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<table border="1" >
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
</table>
<script>
    $("button").click(function(eventObject){
        console.log(eventObject.currentTarget.innerHTML);
                
            name = eventObject.currentTarget.innerHTML;
            
            
            $.get("delete.php", {name: name}, function(data){
                $('table').empty();
                $('table').append(data);
                console.log(data);
            });
    });
</script>