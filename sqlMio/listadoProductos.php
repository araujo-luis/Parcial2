<?php
  session_start();
  require_once("libreria.php");

  $lst_prddsc_f="";
  $lst_prdest_f="ACT";

  if(isset($_SESSION["lst_prddsc_f"])){
    $lst_prddsc_f = $_SESSION["lst_prddsc_f"];
    $lst_prdest_f = $_SESSION["lst_prdest_f"];
  }

  if(isset($_POST["btnFiltrar"])){
    $lst_prddsc_f = $_POST["txtPrdDsc"];
    $lst_prdest_f = $_POST["cmbPrdEst"];

    $_SESSION["lst_prdest_f"] = $lst_prdest_f;
    $_SESSION["lst_prddsc_f"] = $lst_prddsc_f;

  }

  $Productos = obtenerProductos($lst_prddsc_f,$lst_prdest_f);

 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Listado de Productos</title>
  </head>
  <body>
    <h1>Filtrado</h1>

    <form action=" <?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
      <label for="txtPrdDsc">Filtro de Busqueda</label>
      <input type="text" name="txtPrdDsc" id="txtPrdDsc" placeholder="Busqueda" value="<?php echo $lst_prddsc_f;?>">
      <BR>
      <select name="cmbPrdEst">
        <option value="ACT"
        <?php ($lst_prdest_f=="ACT")?"selects=selected":""; ?>
        >Activo
        </option>

        <option value="INA"
        <?php ($lst_prdest_f=="INA")?"selects=selected":""; ?>
        >Inactivo</option>

        <option value="RTR"
        <?php ($lst_prdest_f=="RTR")?"selects=selected":""; ?>
        >Retirado</option>

        <option value="PLN"
        <?php ($lst_prdest_f=="PLN")?"selects=selected":""; ?>
        >Stand By</option>
      </select>
<BR>
      <input type="submit" name="btnFiltrar" value="Filtrar">
    </form>

    <a href="detalleProducto.php?mode=INS">Ingresar nuevo producto</a>
    <h1>Listado de Productos</h1>

    <table>
      <tr>
        <th>Codigo</th>
        <th>Descripcion</th>
        <th>Categoria</th>
        <th>Precio</th>
        <th>Stock</th>
        <th>Estado</th>
        <th>Acciones</th>
       </tr>
      <?php
      foreach ($Productos as $value) {


        echo '<tr>';

          echo '<td>';
            echo $value["prdcod"];
          echo '</td>';

          echo '<td>';
            echo $value["prddsc"];
          echo '</td>';

          echo '<td>';
            echo $value["ctgcod"];
          echo '</td>';

          echo '<td>';
            echo $value["prdprc"];
          echo '</td>';

          echo '<td>';
            echo $value["prdstk"];
          echo '</td>';

          echo '<td>';
            echo $value["prdest"];
          echo '</td>';

          echo '<td>';
            echo '<a href="detalleProducto.php?mode=DSP&codigo='. $value["prdcod"]. '">Ver | </a>';
            echo '<a href="detalleProducto.php?mode=UPD&codigo='. $value["prdcod"]. '">Actualizar | </a>';
            echo '<a href="detalleProducto.php?mode=DEL&codigo='. $value["prdcod"]. '">Eliminar | </a>';
          echo '</td>';
        echo '</tr>';
      }
      ?>

    <table>
  </body>
</html>
