<?php

include '../../../models/conexion.php';
include '../../../controllers/funciones.php';
include '../../../models/procesos.php';

$idproducto = $_POST['idproducto'];
$codproducto = $_POST['codproducto'];
$producto = $_POST['producto'];
$descripcion = $_POST['descripcion'];
$idcategoria = $_POST['idcategoria'];
$precio_venta = $_POST['precio_venta'];
$precio_compra = $_POST['precio_compra'];
$idproveedor = $_POST['idproveedor'];
$fecha_ingreso = $_POST['fecha_ingreso'];
$stock = $_POST['stock'];

// Obtenemos los atributos del archivo
$imgFile = $_FILES['imagen']['name'];
$tmp_dir = $_FILES['imagen']['tmp_name'];
$imgSize = $_FILES['imagen']['size'];

$path = "../../../public/img/productos/";

$imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); //Obtenemos la extención del archivo
$newName = $producto . "." . $imgExt; //Asignamos un nuevo nombre al archivo

$carga_img = CargaIMG($tmp_dir, $newName, $path);

$buscaData = buscavalor("inventarios", "COUNT(codproducto)", "codproducto = '$codproducto'");

$tabla0 = "productos";
$campos0 = "idproducto, codproducto, producto, descripcion,precio_venta,precio_compra,idproveedor,fecha_ingreso,stock, imagen, estado";
$valores0 = "'$idproducto','$codproducto','$producto','$descripcion','$precio_venta','$precio_compra','$idproveedor','$fecha_ingreso','$stock','$newName','1'";

$carga_img = CargaIMG($tmp_dir, $newName, $path);

switch ($carga_img) 
{
    case 0;
        echo '<script>
                    alertify.error("Error datos e Imagen no cargados...");
                    $("#ModalNewProducto").modal("hide");
                    $("#contenido-panel").load("./views/panel/productos/principal.php");
                </script>';
        break;
    case 1:
        if (CRUD("INSERT INTO $tabla0($campos0) VALUES($valores0)", "i"))
        {
            if ($buscaData != 0) {
                $stockInventario = buscavalor("inventarios", "stock", "codproducto='$codproducto'");
                $newStock=($stockInventario + $stock);

                $tabla1 = "inventarios";
                $campos1U = "stock = '$newStock '";
                $condicion1= "codproducto='$codproducto'";

                $update1 = CRUD("UPDATE $tabla1 SET $campos1U WHERE $condicion1","u");

                $idinventario = buscavalor("inventarios","idinventario","codproducto='$codproducto'");

                $tabla2 = "detalle_inventario";
                $campos2 = " idinventario , idproducto, fecha_ingreso,idcategoria,stock";
                $valores2= "'$idinventario','$idproducto','$fecha_ingreso','$idcategoria','$stock'";

                $insertDI = CRUD ("INSERT INTO $tabla2 ($campos2) VALUES ($valores2)","i");
            }
            else 
            {
                $tabla1 = "inventarios";
                $campos1 = "codproducto,idcategoria,stock";
                $valores1= "'$codproducto','$idcategoria','$stock'";

                $insert1= CRUD("INSERT INTO $tabla1 ($campos1) VALUES ($valores1)","i");

                $idinventario = buscavalor("inventarios","idinventario","codproducto='$codproducto'");

                $tabla2 = "detalle_inventario";
                $campos2 = " 'idinventario' , 'idproducto', 'fecha_ingreso','idcategoria','stock'";
                $valores2= "'$idinventario','$idproducto','$fecha_ingreso','$idcategoria','$stock'";

                $insertDI = CRUD ("INSERT INTO $tabla2 ($campos2) VALUES ($valores2)","i");
            }
            echo 
            '<script>
                alertify.sucess("Producto registrado...");
                $("#ModalNewProducto").modal("hide");
                $("#contenido-panel").load("./views/panel/productos/principal.php");
            </script>';
    }
    else{
        echo 
        '<script> alertify.error("Error al registrar producto ...");
                $("#ModalNewProducto").modal("hide");
                $("#contenido-panel").load("./views/panel/productos/principal.php");
        </script>';
    }
    break;
}
?>