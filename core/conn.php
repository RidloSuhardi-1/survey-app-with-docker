<?php

    $host = "10.0.0.170";
    $user = "admin";
    $pass = "Password123*";
    $database = "survey";

    $connect = mysqli_connect($host, $user, $pass, $database);

if (!$connect) {
  echo("Connection failed: " . mysqli_connect_error());
}
?>
