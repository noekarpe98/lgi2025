<?php
extract($_REQUEST);

$color="white";

if ($edad > 10 && $edad < 20){
    $color="lightgreen";
}
elseif ($edad > 20 && $edad < 40){
    $color="yellow";
}
elseif ($edad > 40 && $edad < 60){
    $color="red";
}
?>

<html>
    <head>
        <title>
            Edad
        </title>
    </head>
        <body bgcolor=<?=$color?>>
            <?php
            echo ("Tu Nombre es $nombre");
            "<br>";
            echo ("Tu Edad es $edad");
            ?>
        </body>
</html>