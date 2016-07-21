<?php
    session_start();
    define('TITLE', 'Movie Genre');
    
    include_once 'database_connection.php';    
    

    if(empty($_GET['genre']))
    {
        header("location: home_page.php");
    }
    else {
        $genre = $_GET['genre'];
   }
    require 'header.php';
?>
        
        <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <?php echo $genre;?>
            </h1>                
        </div>
            
        <?php


          foreach ($dbc->query("SELECT * FROM movie WHERE genre = '$genre' ORDER BY publish_date DESC") as $rows)
          {

              echo '<div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4><a href="view_movie.php?movie_id='.$rows['id'].'">'.$rows['movie_name'].'</a></4>
                            </div>
                            <div class="panel-body">
                                <div class="imgcontainer">      
                                    <img src="'.$rows['movie_poster'].'">
                                </div>                                    
                            </div>        
                        </div>                        

                    </div>';
          }

    require 'footer.php';
?>
