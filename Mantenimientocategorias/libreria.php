<?php

$conexion = new mysqli();
function conectar(){
  global $conexion;

  $host ="localhost";
  $user = "root";
  $pass= "";
  $db="nw201502";

  $conexion->connect($host,$user,$pass,$db);

  if($conexion->errno){
    echo ($conexion->error);

  }
}

function desconectar(){
  global $conexion;
  $conexion->close();
}


function getCategorias($descripcion, $estado){
  global $conexion;
  conectar();

  $descripcion= "%". $conexion->real_escape_string($descripcion)."%";
  $estado= $conexion->real_escape_string($estado);

  $query = "select * from categorias where ctgdsc like '%s' and ctgest='%s'";

  $query= sprintf($query,$descripcion,$estado);

  $cursor= $conexion->query($query);

  $categorias=array();
  if($cursor){
    while($categoria= $cursor->fetch_assoc()){
      $categorias[]= $categoria;
    }
  }
  desconectar();

  return $categorias;

}

 ?>
