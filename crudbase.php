<?php
$servidor="localhost";
$usuario="root";
$clave="";
$base="login";

$con=mysqli_connect($servidor,$usuario,$clave,$base);

if(!$con){
    die("ERROR_CONEXION");
}

if(isset($_POST['guardar'])){
    $nombre   = $_POST['nombre'];
    $idjugador   = $_POST['idjugador'];
    $punto = $_POST['punto'];

    $sql = "INSERT INTO puntos (nombre, idjugador, punto) 
            VALUES ('$nombre', '$idjugador', '$punto')";

    if($con->query($sql)){
        echo "OK";
    } else {
        echo "ERROR";
    }

    exit();
}
// === VER TODOS LOS REGISTROS ===
if(isset($_GET['ver'])){
    $sql = "SELECT * FROM puntos ORDER BY punto DESC";
    $res = $con->query($sql);

    $datos = [];

    while($row = $res->fetch_assoc()){
        $datos[] = $row;
    }

    echo json_encode($datos);
    exit();
}
if(isset($_POST['eliminar'])){
    $id = $_POST['id'];

    $sql = "DELETE FROM puntos WHERE id = $id";

    echo ($con->query($sql)) ? "OK" : "ERROR";
    exit();
}

if(isset($_POST['actualizar'])){
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $idjugador = $_POST['idjugador'];
    $punto = $_POST['punto'];

    $sql = "UPDATE puntos
            SET nombre='$nombre', idjugador='$idjugador', punto='$punto'
            WHERE id='$id'";

    if($con->query($sql)){
        echo "OK";
    } else {
        echo "ERROR_UPDATE";
    }
    exit;
}
$con->close();
?>