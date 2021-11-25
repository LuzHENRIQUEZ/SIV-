<?php
    include '../../../models/conexion.php';
    include '../../../controllers/funciones.php';
    include '../../../models/procesos.php';

    $DataCR = CRUD("SELECT * FROM codregistros","s"); //Datos de tabla codrrgistros
    
    $DataCate = CRUD("SELECT * FROM categorias", "s"); //Datos de Tabla categorias
    $DataProve = CRUD("SELECT * FROM proveedores", "s"); // Datos de tabla proveedores
    $DataMaxId = CRUD("SELECT MAX(idproducto) AS ultimoid FROM productos","s");

    foreach($DataMaxId AS $result)
    {
        $idproducto = $result['ultimoid']+1;
    }
?>
<script src="./public/js/funciones-productos.js"></script>
<script src="./public/js/funciones.js"></script>
<form id="FormNewProducto" enctype="multipart/formdata">
    <form id="NewProducto" enctype="multipart/formdata">
    <input type="hidden" name = "idproducto" value="<?php echo $idproducto; ?>" >
    <div class="row">
        <div class="col-md-6">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" id="basic-addon1" for="inputGroupSelect01" >Serie: </label>
                </div>
                <select class="custom-select" name="codproducto" id="codreg">
                    <option value="0" selected>Seleccione Codigo Registro</option>
                    <?php foreach ($DataCR as $result) : ?>
                        <option value="<?php echo $result['codreg']; ?>"><?php echo $result['nombre_registro']; ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Nombre Producto: </span>
                </div>
                <input type="text" name="producto" class="form-control" placeholder="Nombre Producto" required="ON">
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Descripción: </span>
                    <textarea type="text" name="descripcion" rows="10" cols="30" placeholder="Descripción del producto"></textarea>
                </div>
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Categoria:</label>
                </div>
                <select class="custom-select" name="idcategoria" id="idcategoria">
                    <option value="0" selected>Seleccione Categoria</option>
                    <?php foreach ($DataCate as $result) : ?>
                        <option value="<?php echo $result['idcategoria']; ?>"><?php echo $result['categoria']; ?></option>
                    <?php endforeach ?>
                </select>
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Precio Venta: </span>
                </div>
                <input type="number" name="precio_venta" class="form-control" placeholder="Precio Venta" required="ON">
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Precio Compra: </span>
                </div>
                <input type="number" name="precio_compra" class="form-control" placeholder="Precio Compra" required="ON">
            </div>
        </div>

        <div class="col-md-6">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Proveedor:</label>
                </div>
                <select class="custom-select" name="idproveedor" id="idproveedor">
                    <option value="0" selected>Seleccione Proveedor</option>
                    <?php foreach ($DataProve as $result) : ?>
                        <option value="<?php echo $result['idproveedor']; ?>"><?php echo $result['proveedor']; ?></option>
                    <?php endforeach ?>
                </select>
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Fecha de ingreso: </span>
                </div>
                <input type="date" name="fecha_ingreso" class="form-control" placeholder="Fecha" required="ON">
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Productos en stock: </span>
                </div>
                <input type="number" name="stock" class="form-control" placeholder="Stock" required="ON">
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupFileAddon01">Foto</span>
                </div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input imagen" name="imagen" id="" aria-describedby="inputGroupFileAddon01">
                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                </div>
            </div>
            <div>
                <img src="" width="200px" alt="" id="muestraimagen">
            </div>
        </div>
    </div>
    <div style="margin-top:10px">
        <button class="btn btn-primary">Guardar</button>
    </div>
</form>