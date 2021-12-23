<?php

    session_start();
    include 'conn.php';

    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $remember = $_POST['remember'];


    if (empty($email) || empty($password)) {
        header("location: ../login.php?error=empty_fields");
    }

    $query = mysqli_query($connect, "SELECT * FROM users WHERE email = '$email' AND password = '$password'");
    $check = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);

    if ($check > 0) {
        if (isset($remember)) {
            session_start();
            setcookie("email", $email, time()+3600, "/");

            $_SESSION['id'] = $row['id'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['email'] = $email;
            $_SESSION['authenticated'] = true;

            header("location: ../index.php");
        } else {
            session_start();
            $_SESSION['id'] = $row['id'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['email'] = $email;
            $_SESSION['authenticated'] = true;

            header("location: ../index.php");
        }
    } else {
        echo mysqli_error($connect);
        header("location: ../login.php?error=signin_failed");
    }

?>