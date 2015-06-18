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

    function obtenerProductos(){
        global $conn;
        $Productos = array();
        $cursorProductos = $conn->query("select * from productos;");
        if($cursorProductos){
            while($producto = $cursorProductos->fetch_assoc()){
                $Productos[] = $producto;
            }
        }
        return $Productos;
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
