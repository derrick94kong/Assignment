<?php
    session_start();
    define('TITLE', 'Search Movie');
    
    include_once 'database_connection.php';    
    require 'header.php';
?>
        
        <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Searching for "<?php echo $_GET['search']; ?>"
            </h1>                
        </div>
            
        <?php
            
          $search = $_GET['search'];
          $founded = false;

          foreach ($dbc->query("SELECT * FROM movie WHERE movie_name LIKE '%$search%'") as $rows)
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
              $founded = true;
        }
        if(!$founded)
        {
            echo '<div class="row">'
                    . '<div class="col-md-12" style="height: 10vh;">'
                    . '<h4>No movie name match with '."$search".'...</h4>'
                . '</div>'
                  . '<div class="col-lg-12">
                    <h1 class="page-header">
                        Movie May Like
                    </h1>                
                </div>';
            
            foreach ($dbc->query("SELECT * FROM movie ORDER BY RAND() DESC LIMIT 3") as $rows)
            {
              if (strlen($rows['movie_name']) > 20)
                {
                    $movie_name = substr($rows['movie_name'], 0, 20) . '...';
                }
                else 
                {
                    $movie_name = $rows['movie_name'];
                }
                         
                    echo '  <div class="col-md-4">
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
            echo '</div>';
        }
        
    require 'footer.php';
?>