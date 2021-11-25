<?php 
    @session_start();
    include '../../../models/conexion.php';
    include '../../../controllers/funciones.php';
    include '../../../models/procesos.php';

    $idcr = $_GET['idcr'];

    $tabla = "codregistros";
    $condicion = "idcr='$idcr'";

    $insert = CRUD("DELETE FROM $tabla  WHERE $condicion","d");

    if($insert)
    {
        echo '<script>
                alertify.success("Registro eliminado...");
                $("#contenido-panel").load("./views/panel/productos/principal_registro.php");
            </script>';
    }
    else
    {
        echo '<script>
                alertify.error("Error no eliminado registro...");
                $("#contenido-panel").load("./views/panel/productos/principal_registro.php");
            </script>';
    }
?>