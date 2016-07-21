<?php
    session_start();
    
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


          foreach ($dbc->query("SELECT * FROM movie ORDER BY publish_date DESC LIMIT 3") as $rows)
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
        ?>
            
        <div class="col-lg-12" style="margin-bottom: 10px">
            <h4><a href="latest_movie.php" style="float: right;">View more</a></h4>   
        </div>
    </div>
    <!-- /.row -->
    
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Movie May Like
            </h1>                
        </div>
    
    <?php


          foreach ($dbc->query("SELECT * FROM movie ORDER BY RAND() DESC LIMIT 4") as $rows)
          {
              if (strlen($rows['movie_name']) > 20)
                {
                    $movie_name = substr($rows['movie_name'], 0, 20) . '...';
                }
                else 
                {
                    $movie_name = $rows['movie_name'];
                }
                         
                    echo '<div class="col-md-3">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4><a href="view_movie.php?movie_id='.$rows['id'].'" title="'.$rows['movie_name'].'">'.$movie_name.'</a></4>
                                </div>
                                <div class="panel-body">
                                    <div class="imgcontainer">      
                                        <img src="'.$rows['movie_poster'].'">
                                    </div>                                    
                                </div>        
                            </div>                                             
                          </div>';
          }
        ?>
    
    </div>
<?php
    require 'footer.php';
?>