<?php
    session_start();
    define('TITLE', 'Lastest Movie');
    
    include_once 'database_connection.php';    
    require 'header.php';
?>
        
        <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Lastest Movie
            </h1>                
        </div>
            
        <?php


          foreach ($dbc->query("SELECT * FROM movie ORDER BY publish_date DESC limit 12") as $rows)
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