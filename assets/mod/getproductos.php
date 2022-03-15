<?php
require_once("connect.php");
require_once("class.Producto.php");
$producto = new Producto();
$productoCond['return_type'] = 'all';
$productos = $producto->getRows($productoCond);

    $i = 0;
    $j = count($productos);
    echo "<script>var productos = [";
    foreach ($productos as $producto){
        if($i == $j-1){
            echo "'".$producto["nombre"]."'"; 
        }else{
        echo "'".$producto["nombre"]."',";
        }
        $i++;
    }
    echo "];";
    $k = 0;
    $f = count($productos);
    echo "
    var idproductos = [";
    foreach ($productos as $producto){
        if($k == $f-1){
            echo "'".$producto["id"]."'"; 
        }else{
        echo "'".$producto["id"]."',";
        }
        $k++;
    }
    echo "];";
    echo "</script>";
    ?>