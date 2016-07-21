<?php
    session_start();
    define('TITLE', 'Movie Genre');
    
    include_once 'database_connection.php';    
    require 'header.php';
    
    echo '<div class="col-lg-12">
            <h1 class="page-header">
                Movie Genre
            </h1>                
          </div>';
    
    foreach($dbc->query("SELECT DISTINCT genre FROM movie") as $genre_row)
    {
       
         echo '<div class="col-lg-4" style="max-height: 760px;">
                    <div class="col-lg-12">
                        <h2 class="page-header">
                            '.$genre_row['genre'].'
                        </h2>
                    </div>';                 

          foreach ($dbc->query('SELECT * FROM movie WHERE genre = "'.$genre_row['genre'].'" ORDER BY RAND() DESC LIMIT 1') as $rows)
          {
            if (strlen($rows['movie_name']) > 29)
            {
                $movie_name = substr($rows['movie_name'], 0, 29) . '...';
            }
            else 
            {
                $movie_name = $rows['movie_name'];
            }
            
              echo '<div class="col-md-12">
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
                    </div>
                    
                    <div class="col-lg-12" style="margin-bottom: 10px">
                            <h4><a href="view_moviegenre.php?genre='.$genre_row['genre'].'" style="float: right;">View more</a></h4>   
                        </div>
                </div>';
          }
    }
?>
    

<?php
    require 'footer.php';
?>