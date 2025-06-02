<?php 
  $con = mysqli_connect("127.0.0.1","root","","etec-database",3307);

  if(!$con){
    echo "Error". mysqli_connect_error();

    exit;
  }
?>