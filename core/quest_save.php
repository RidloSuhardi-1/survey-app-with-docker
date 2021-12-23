<?php
    session_start();

    include 'conn.php';

    $name = $_POST['name'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $footnote = $_POST['footnote'];

    if (empty($footnote))
    {
        $footnote = 'none';
    }

    $query = mysqli_query(
        $connect, 
        "INSERT INTO quest (title, content, footnote, name, user_id) 
        VALUES ('".$title."', '".$content."', '".$footnote."', '".$name."', '".$_SESSION['id']."')"
    );

    if ($query) {
        header("location: ../index.php");
    } else {
        echo mysqli_error($connect);
        header("location: ../question_maker.php?error=save_errors");
    }

?>