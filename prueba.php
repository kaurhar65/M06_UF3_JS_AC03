<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php

include "dbConfig.php";


//Connectar a la base de dades, ha d'estar en aquest ordere.
$connect = mysqli_connect(DB_HOST, DB_USER, DB_PSW, DB_NAME, DB_PORT);
$cat = 1;


//Si no aconseguiex conectar a la BD salta un error.
if (!$connect) {
    echo "ERROR!!!!" . mysqli_connect_error();
} else {
    $consulta = "SELECT * FROM subcategorias WHERE catId = $cat";
    $conexionBD = mysqli_query($connect, $consulta);
    $return = array();

    if($conexionBD){
        $numResultat = mysqli_num_rows(($conexionBD));
        if($numResultat > 0){
            while ($row = mysqli_fetch_assoc($conexionBD)) {
                $object = new stdClass();
                $object->nom = $row["name"];
                $object->id = $row["subId"];

                array_push($return, $object);
            }
        } else {
            echo "No s'han trobat resultats.";
        }
    } else {
        echo "Error en la consulta: " . mysqli_error($connect);
    }


    echo json_encode($return);
    $connect->close();

}
?>
</body>
</html>