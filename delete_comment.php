<?php

    $comment_id = $_GET['comment_id'];
    $movie_id = $_GET['movie_id'];
    
    $dbc =  mysqli_connect('localhost', 'root', '','movieviewer');
    $delete_comment = "DELETE FROM movie_comment WHERE id = '$comment_id' and movie_id = '$movie_id'";
    $data= mysqli_query($dbc,$delete_comment)or die(mysqli_connect_error());
    if($data)
    {
        header("location: view_movie.php?movie_id=$movie_id");
    }

?>     