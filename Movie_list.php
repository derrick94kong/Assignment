<?php
    session_start();
    define('TITLE', 'Movie List');
    
    include_once 'database_connection.php';    
    require 'header.php';
?>
        
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Movie List ( A-Z )
                </h1>                
            </div>
            
            <div class="col-lg-12">
                <?php
                    foreach (range('A', 'Z') as $char) 
                    {
                        echo "<a href='#$char' style='padding: 10px;'>$char</a> | ";
                    }
                ?>
            </div>
            
            <?php
            
                foreach (range('A', 'Z') as $searcher)
                {
                    echo '<div class="col-lg-6" id="'.$searcher.'">
                            <div class="col-lg-12">
                                <h1 class="page-header">
                                    '.$searcher.'
                                </h1>';
                                
                    foreach ($dbc->query("SELECT * FROM movie WHERE movie_name LIKE '$searcher%'") as $rows)
                    {
                        $movie_id = $rows['id'];
                        $movie_link = "view_movie.php?movie_id=$movie_id";
                        echo '<h3><a href="'.$movie_link.'">'.$rows['movie_name'].'</a></h3>';
                    }
                                                        
                    echo '     </div>
                          </div>';
                }
                
               
            
            ?>                        
        </div>

<?php       
    require 'footer.php';
?>