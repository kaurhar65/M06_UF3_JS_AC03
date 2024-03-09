
<?php
    define("DB_HOST", "localhost");
    define("DB_NAME", "prueba");
    define("DB_USER", "root");
    define("DB_PSW", "");
    define("DB_PORT", 3306);
    $conexionBD = null;  
    $idCat = $_POST['cat'];

//Connectar a la base de dades, ha d'estar en aquest ordere.
$connect = mysqli_connect(DB_HOST, DB_USER, DB_PSW, DB_NAME, DB_PORT);


//Si no aconseguiex conectar a la BD salta un error.
if (!$connect) {
    echo "ERROR!!!!" . mysqli_connect_error();
} else {
    $consulta = "SELECT * from `subcategorias` WHERE catId =".$idCat;
    $conexionBD = mysqli_query($connect, $consulta);
    $return = array();

    if($conexionBD){
        $numResultat = mysqli_num_rows(($conexionBD));
        if($numResultat > 0){
            while ($row = mysqli_fetch_assoc($conexionBD)) {
                $object = new stdClass();
                $object->subId= $row["subId"];
                $object->name = $row["name"];
                $object->catId = $row["catId"];

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
