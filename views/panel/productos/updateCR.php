<?php
    include '../../../models/conexion.php';
    include '../../../controllers/funciones.php';
    include '../../../models/procesos.php';
    
    $idcr = $_POST['idcr'];
    $codreg = $_POST['codreg'];
    $nombre_registro = $_POST['nombre_registro'];  
    

    $tabla = "codregistros";
    $campos = "codreg='$codreg', nombre_registro='$nombre_registro'";
    $condicion = "idcr='$idcr'";
    $update = CRUD("UPDATE $tabla SET $campos WHERE $condicion","u");
    
    if($update){
        echo '<script>
                alertify.success("Registro actualizados...");
                $("#ModalEditCR").modal("hide");    
                $("#contenido-panel").load("./views/panel/productos/principal_registro.php");
            </script>';
    }
    else{
        echo '<script>
                alertify.error("Error al actualizar registro...");
                $("#ModalEditCR").modal("hide");
                $("#contenido-panel").load("./views/panel/productos/principal_registro.php");
            </script>';
    }

?>