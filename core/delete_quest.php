<?php
    session_start();
    include "conn.php";

    $sql = mysqli_query($connect, "DELETE FROM quest WHERE id = '".$_GET['id']."' ");
    header("location: ../question.php");

?>