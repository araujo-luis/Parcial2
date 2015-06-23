
  <?php
  session_start();
  require_once("libreria.php");

  $filtroDescripcion ="";
  $filtroEstado ="";

  if(isset($_SESSION["filtroDescripcion"])){
    $filtroDescripcion =$_SESSION["filtroDescripcion"];
    $filtroEstado =$_SESSION["filtroEstado"];
  }

  if (isset($_POST["btnFiltrar"])) {
    $filtroDescripcion =$_POST["txtFiltro"];
    $filtroEstado =$_POST["cmbEstado"];

    $_SESSION["filtroDescripcion"] =$filtroDescripcion ;
    $_SESSION["filtroEstado"] =$filtroEstado ;

  }

  $categorias=getCategorias($filtroDescripcion,$filtroEstado);


  ?>
  <!DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8"/>
      <title>Listado de Categorias</title>
    </head>
    <body>

      <form action="listadoCategorias.php" method="post">
        <label for="txtFiltro">Filtro</label>
        <input type="text" name="txtFiltro" id="txtFiltro" value="<?php echo $filtroDescripcion;?>"
          placeholder="Nombre Categoria">
        <br>

        <label for="cmbEstado"><label>
          <select name="cmbEstado">
            <option value="ACT"
            <?php echo ($filtroEstado=="ACT")?"selected=selected":"";?>
            >Activa</option>

            <option value="INA"
            <?php echo ($filtroEstado=="INA")?"selected=selected":"";?>
            >Desactiva</option>
          </select>
          <br>
          <input type="submit" name="btnFiltrar" id="btnFiltrar">
      </form>
      <BR><br>
      <a href="detalleCategorias.php?mode=INS">Ingresar Nueva Categoria</a>
<br><br>
      <table>

        <tr>
          <th>Codigo</th>
          <th>Descripcion</th>
          <th>Estado</th>
          <th>Acciones</th>
        </tr>

        <?php
        foreach ($categorias as  $value) {

        echo '<tr>';
          echo '<td>'. $value["ctgcod"] .'</td>';
          echo '<td>'. $value["ctgdsc"] .'</td>';
          echo '<td>'. $value["ctgest"] .'</td>';
          echo '<td>';
          echo  '<a href="detalleCategorias.php?mode=VER&ctgcod'. $value["ctgcod"].'">Ver</a> | ';
          echo  '<a href="detalleCategorias.php?mode=ACT&ctgcod'. $value["ctgcod"].'">Actualizar</a> | ';
          echo  '<a href="detalleCategorias.php?mode=ELI&ctgcod'. $value["ctgcod"].'">Eliminar</a> | ';
          echo  '</td>';

        echo '</tr>';
        }
         ?>
      </table>

    </body>
  </html>
