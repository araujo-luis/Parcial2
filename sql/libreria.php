<?php
    $host = "127.0.0.1";
    $user = "root";
    $pswd = "";
    $db = "nw201502";

    $conn = new mysqli($host,
                     $user,
                     $pswd,
                     $db);

    if($conn->errno){
        die($conn->error);
    }

    function obtenerProductos($filtroDesc, $filtroEstado){
        global $conn;
        //cuando llega algo raro,
        // '; drop database();
        //el espace la conviert esto asi
        // '\; drop database()\(\);

        $filtroDesc = $conn->real_escape_string($filtroDesc)."%";
        $filtroEstado = $conn->real_escape_string($filtroEstado);

        $Productos = array();
        $cadena = "select * from productos where prddsc like '%s' and prdest = '%s';";

        //es cuestion de seguridad para evtar las injeccion SQL
        //como en C en los porcentaje S es

        $cadena= sprintf($cadena, $filtroDesc,$filtroEstado);
        $cursorProductos = $conn->query($cadena);

        if($cursorProductos){
            while($producto = $cursorProductos->fetch_assoc()){
                $Productos[] = $producto;
            }
        }
        return $Productos;
    }

    function obtenerProducto($codigo){
        global $conn;
        //cuando llega algo raro,
        // '; drop database();
        //el espace la conviert esto asi
        // '\; drop database()\(\);



        $Producto = array();
        $cadena = "select * from productos where prdcod =%s";

        //es cuestion de seguridad para evtar las injeccion SQL
        //como en C en los porcentaje S es

        $cadena= sprintf($cadena, $codigo);
        $cursorProducto = $conn->query($cadena);

        if($cursorProducto){
            while($producto = $cursorProducto->fetch_assoc()){
                return  $producto;
                break;
            }
        }
        return $Producto;
    }

    function obtenerProductosFind($nombre, $estado){
      global $conn;
      $productos = array();
      $cursor = $conn->query("select * from productos
                              where prddsc like '%".$nombre. "%' and prdest='".$estado ."';");


      if($cursor){
        while($producto = $cursor->fetch_assoc()){
          $productos[] = $producto;
        }

      }
      return $productos;
    }

 ?>
