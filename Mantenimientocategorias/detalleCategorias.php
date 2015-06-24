<?php
  require_once("libreria.php");
  $modo ="";
  $titulo= "";
  $categoriaDB= array(
    "ctgcod"=> 0,
    "ctgdsc"=>"",
    "ctgest"=>""
  );

  if(isset($_POST["txtCtgCod"])){
    //$categoriaDB= getCategoria($_GET["ctgcod"]);
    $modo = $_GET["mode"];
    if($modo=="INS"){

      insertarCategoria($_POST["txtCtgDsc"] , $_POST["cmbEstado"]);

      $_GET["mode"] = "ACT";
      $_GET["ctgcod"] = getLastInsertID();

    }elseif ($modo=="ACT") {
      actualizarCategoria($_POST["txtCtgCod"],$_POST["txtCtgDsc"],$_POST["cmbEstado"]);
      header("Location: listadoCategorias.php");
      die();
    }elseif ($modo=="ELI") {
      eliminarCategoria($_POST["txtCtgCod"]);
      header("Location: listadoCategorias.php");
      die();
    }

  }

  if(isset($_GET["mode"])){
    $modo = $_GET["mode"];

    switch ($modo) {
      case 'VER':

        $categoriaDB= getCategoria($_GET["ctgcod"]);
        $titulo="Ver Categoria ". $categoriaDB["ctgdsc"];
        break;

      case 'ACT':

        $categoriaDB= getCategoria($_GET["ctgcod"]);
        $titulo="Actualizar Categoria". $categoriaDB["ctgdsc"];

        break;

      case 'ELI':

        $categoriaDB= getCategoria($_GET["ctgcod"]);
        $titulo="Eliminar Categoria". $categoriaDB["ctgdsc"];

        break;

      case 'INS':
        $titulo="Insertar Categoria";

        break;

      default:
        header("Location:listadoCategorias.php");
        die();
        break;
    }
  }
  else {
    header("Location:listadoCategorias.php");
    die();
  }

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <title>Detalle Categorias</title>
  </head>
  <body>

    <h1><?php echo $titulo;?></h1>
    <a href="listadoCategorias.php">Regresar</a>

    <form action="detalleCategorias.php?mode=<?php echo $modo;?>&ctgcod=<?php echo $categoriaDB["ctgcod"];?>" method="post">
      <input type="hidden" name="txtCtgCod" value="<?php echo $categoriaDB["ctgcod"];?>">
      <label for="txtCtgDsc">Descripcion</label>
      <input type="text" name="txtCtgDsc" id="txtCtgDsc" placeholder="Descripcion de Categoria" value="<?php echo $categoriaDB["ctgdsc"];?>">
      <br>

      <label for="cmbEstado">Estado<label>
        <select name="cmbEstado">

          <option value="ACT"
          <?php echo ($categoriaDB["ctgest"]=="ACT")?"selected=selected":"";?>
          >Activa</option>

          <option value="INA"
          <?php echo ($categoriaDB["ctgest"]=="INA")?"selected=selected":"";?>
          >Desactiva</option>
        </select>
        <br>

        <?php
          if ($modo=="INS") {
            //INSERTAR
        ?>
        <input type="submit" name="btnAgregar" id="btnAgregar" value="Agregar">
        <?php }
        if ($modo=="ACT") {
          //ACTUALIZAR
         ?>
        <input type="submit" name="btnActualizar" id="btnActualizar" value="Actualizar">
        <?php }
        if ($modo=="ELI") {
          //ELIMINAR
        ?>
        <input type="submit" name="btnEliminar" id="btnEliminar" value="Eliminar">
        <?php } ?>
    </form>


  </body>
</html>
