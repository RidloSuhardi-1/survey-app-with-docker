<?php
    session_start();
    include 'conn.php';

    $title = $_POST['title'];
    $content = $_POST['content'];
    $footnote = $_POST['footnote'];
    $answer = $_POST['answer'];

    if (empty($answer))
    {
        header("location: ../question_answer.php?error=empty_fields");
    }

    $query = mysqli_query($connect, 
    "INSERT INTO answer (title, content, footnote, answer, name, user_id, quest_id) VALUES ('".$title."', '".$content."', '".$footnote."', '".$answer."', '".$_SESSION['name']."', '".$_SESSION['id']."', '".$_GET['id']."')");

    if ($query) {
        header("location: ../index.php");
    } else {
        header("location: ../question_answer.php?id=".$_GET['id']."?error=save_errors");
        echo mysqli_error($connect);
    }

    mysqli_close($connect);
?>