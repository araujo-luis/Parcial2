<?php
//comentario
    require_once("libreria.php");
    /*
    workwith \ trabajar con

    listado con todos los registros
    opcion : Agregar, Modificar,
             Ver , Eliminar
    filtros: Filtros del Listado

    detalle del Registro

    listadoProductos.php
    detalleProducto.php

    */
    $Productos = obtenerProductos();

    if(isset($_POST["btnFiltrar"])){
      $nombre = $_POST["txtPrdDsc"];
      $estado = $_POST["cmbPrdEst"];

      $Productos = obtenerProductosFind($nombre,$estado);
    }


?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <title>Listado de Producto</title>
  </head>
  <body>
    <div>
        <form action="listadoProductos.php"
             method="post">
                <label for="txtPrdDsc">
                Descripción del Producto</label>
                <input type="text"
                    name="txtPrdDsc"
                    id="txtPrdDsc"
                    placeholder="Descripción del Producto" />
                <br/>
                <label for="cmbPrdEst">Estado</label>
                <select name="cmbPrdEst" id="cmbPrdEst">
                    <option value="ACT">
                        Activo
                    </option>
                    <option value="INA">
                        Inactivo
                    </option>
                    <option value="RTR">
                        Retirado
                    </option>
                    <option value="PLN">
                        Stand By
                    </option>
                </select>
                <br/>
                <input type="submit"
                    name="btnFiltrar"
                    value="Filtrar"
                    />
        </form>
    </div>
    <div>
        <h2>Productos</h2>
        <a href>Ingresar Nuevo Producto</a>
        <table>
            <tr>
                <th>Cod.</th>
                <th>Descripción</th>
                <th>Categoría</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        <?php
            foreach($Productos as $producto){
                echo "<tr>";
                echo "<td>".$producto["prdcod"]."</td>";
                echo "<td>".$producto["prddsc"]."</td>";
                echo "<td>".$producto["ctgcod"]."</td>";
                echo "<td>".$producto["prdprc"]."</td>";
                echo "<td>".$producto["prdstk"]."</td>";
                echo "<td>".$producto["prdest"]."</td>";
                echo "<td>";
                echo "<a href>Ver</a> | ";
                echo "<a href>Editar</a> | ";
                echo "<a href>Eliminar</a>";
                echo "</td></tr>";
            }
        ?>
        </table>
    </div>
  </body>
</html>
