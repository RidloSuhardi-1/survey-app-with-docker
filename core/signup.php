<?php

    session_start();
    
    include 'conn.php';

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $password_confirmation = md5($_POST['password_confirmation']);

    if (empty($name) || empty($email) || empty($password)) {
        header("location: ../register.php?error=empty_fields");
    } else if ($password != $password_confirmation) {
        header("location: ../register.php?error=password_not_match");
    } else {
        $check = mysqli_query($connect, "SELECT email FROM users WHERE email = '$email' ");
        $count = mysqli_num_rows($check);

        if ($count == 0) {
            $query = mysqli_query($connect, "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')");

            if ($query) {
                header("location: ../login.php");
            } else {
                header("location: ../register.php");
            }
        } else {
            header("location: ../register.php?error=user_exists");
        }
    }

?>