<?php
    session_start();
    include_once 'database_connection.php';

        if(!(isset($_SESSION['loginvalidate']) && $_SESSION['loginvalidate'] != ''))
           {
                $loginvalidate = false;
           }
           else
           {
                $loginvalidate = $_SESSION['loginvalidate'];
           }

           echo '<style type="text/css" media="screen">.error {color : red ;}</style>';
            $movie_id = $_GET['movie_id'];
            
            if($loginvalidate)
            {
                 if(!empty($_POST['user_comment']))
                 {                    
                    $user_id = $_SESSION['user_id'];                   
                    $comment = mysqli_real_escape_string($dbc,$_POST['user_comment']);

                    $insert_comment = "INSERT INTO movie_comment (movie_id, user_id, comment) VALUES ('$movie_id','$user_id','$comment')";

                    $data= mysqli_query($dbc,$insert_comment)or die(mysqli_connect_error());
                    if($data)
                    {
                        header("location: view_movie.php?movie_id=$movie_id");
                    }
                }
                else
                {
                    echo '<script>
                             alert("Please enter your comment!"); 
                             window.location = "view_movie.php?movie_id='.$movie_id.'";
                      </script>';                      
                }                   
            }
            else
            {
                echo '<script>
                             alert("Please login to comment!"); 
                             window.location = "view_movie.php?movie_id='.$movie_id.'";
                      </script>';                    
            }                    
?>
 