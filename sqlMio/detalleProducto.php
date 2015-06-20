<?php
  session_start();
  require_once("libreria.php");

  $titulo = "";
  $producto = array();


  if(isset($_POST["btnAgregar"])){


    $prddsc=$_POST["txtPrdDsc"];
    $ctgcod=$_POST["txtCtgCod"];
    $prdprc=$_POST["txtPrdPrc"];
    $prdest=$_POST["cmbPrdEst"];
    $prdstk=$_POST["txtPrdStk"];

    insertarProducto($prddsc,
    $ctgcod,
    $prdprc,
    $prdstk,$prdest
    );

  }

  if(isset($_POST["btnActualizar"])){

    $prdcod = $_POST["txtPrdCod"];

    $prddsc=$_POST["txtPrdDsc"];
    $ctgcod=$_POST["txtCtgCod"];
    $prdprc=$_POST["txtPrdPrc"];
    $prdest=$_POST["cmbPrdEst"];
    $prdstk=$_POST["txtPrdStk"];

    actualizarProducto($prdcod,$prddsc,
    $ctgcod,
    $prdprc,
    $prdstk,$prdest
    );

  }
  if(isset($_GET["mode"])){


    switch ($_GET["mode"]){
      case 'INS':
        $titulo = "Insertar Producto";

        break;
      case 'DSP':
        $titulo = "Ver Producto";
        $producto = obtenerProducto($_GET["codigo"]);
        break;

      case 'UPD':
        $titulo = "Actualizar Producto";
        $producto = obtenerProducto($_GET["codigo"]);

        break;

      case 'DEL':
        $titulo = "Elimiar Producto";
        eliminarProducto($_GET["codigo"]);
        header("Location: listadoProductos.php");
        die();
        break;

      default:
        header("Location: listadoProductos.php");
        die();
        break;
    }
    }else {
      header("Location: listadoProductos.php");
      die();
    }





 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Detalle Producto</title>
  </head>
  <body>

    <h1><?php echo $titulo; ?></h1>

    <form action="detalleProducto.php" method="post">
        <table>
          <tr>
              <td>
                  <label for="txtPrdCod">
                  Codigo</label>
              </td>
              <td>
                  <input type="text"
                      id="txtPrdCod" name="txtPrdCod"
                      value="<?php echo ($_GET["mode"]=='UPD' || $_GET["mode"]=='DSP')?$producto["prdcod"]:"";?>" placeholder="Codigo" readonly/>
              </td>
          </tr>
           <tr>
               <td>
                   <label for="txtPrdDsc">
                   Descripción</label>
               </td>
               <td>
                   <input type="text"
                       id="txtPrdDsc" name="txtPrdDsc"
                       value="<?php echo ($_GET["mode"]=='UPD' || $_GET["mode"]=='DSP')?$producto["prddsc"]:"";?>" placeholder="Descripcíon del Producto"/>
               </td>
           </tr>
           <tr>
               <td>
                   <label for="txtCtgCod">
                   Categoría</label>
               </td>
               <td>
                   <!-- Esto lo cambiaremos por un select
                       de la tabla de categorías en un futuro
                   -->
                   <input type="text"
                       id="txtCtgCod" name="txtCtgCod"
                       value="<?php echo ($_GET["mode"]=='UPD' or $_GET["mode"]=='DSP')?$producto["ctgcod"]:"";?>" placeholder="Categoría"/>
               </td>
           </tr>
           <tr>
               <td>
                   <label for="txtPrdPrc">
                   Precio</label>
               </td>
               <td>
                   <input type="text"
                       id="txtPrdPrc" name="txtPrdPrc"
                       value="<?php echo ($_GET["mode"]=='UPD' or $_GET["mode"]=='DSP')?$producto["prdprc"]:"";?>" placeholder="Precio del Producto"/>
               </td>
           </tr>
           <tr>
               <td>
                   <label for="cmbPrdEst">
                   Estado</label>
               </td>
               <td>
                   <select name="cmbPrdEst" id="cmbPrdEst">
                       <option value="ACT"
                       <?php echo ( ($_GET["mode"]=='UPD' or $_GET["mode"]=='DSP') && $producto["prdest"]=="ACT")?"selected=select" :"";?>
                       >
                           Activo
                       </option>
                       <option value="INA"
                       <?php echo (($_GET["mode"]=='UPD' or $_GET["mode"]=='DSP') && $producto["prdest"]=="INA")?"selected=select" :"";?>
                       >
                           Inactivo
                       </option>
                       <option value="RTR"
                       <?php echo (($_GET["mode"]=='UPD' or $_GET["mode"]=='DSP') && $producto["prdest"]=="RTR")?"selected=select" :"";?>
                       >
                           Retirado
                       </option>
                       <option value="PLN"
                       <?php echo (($_GET["mode"]=='UPD' or $_GET["mode"]=='DSP') && $producto["prdest"]=="PLN")?"selected=select" :"";?>
                       >
                           Stand By
                       </option>
                   </select>
               </td>
           </tr>
           <tr>
               <td>
                   <label for="txtPrdStk">
                   Stock</label>
               </td>
               <td>
                   <input type="text"
                       id="txtPrdStk" name="txtPrdStk"
                       value="<?php echo ($_GET["mode"]=='UPD' OR $_GET["mode"]=='DSP')?$producto["prdstk"]:""; ?>" placeholder="Stock del Producto"/>
               </td>
           </tr>
           <tr>
               <td colspan="2">
                 <?php
                  if($_GET["mode"] == 'UPD'){
                  ?>
                   <input type="submit"
                       id="btnActualizar"
                       name="btnActualizar"
                       value="Actualizar"/>

                  <?php }elseif($_GET["mode"] == 'INS'){ ?>
                    <input type="submit"
                        id="btnAgregar"
                        name="btnAgregar"
                        value="Agregar"/>

                    <?php } ?>

               </td>
           </tr>
        </table>
    </form>

  </body>
</html>
