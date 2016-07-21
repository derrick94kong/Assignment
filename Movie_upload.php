       
        <?php
            
            session_start();
            define('TITLE', 'Upload Movie');
            
            include_once 'database_connection.php';
            
            if($_SESSION['level'] != 2)
            {
                header('location: home_page.php');
            }
            
            echo '<style type="text/css" media="screen">.error {color : red ;}</style>';
        
           if(isset($_POST['submitted']))
           { 
                $dbc=  mysqli_connect('localhost', 'root', '','movieviewer');
                $moviename=$_POST['movie_name'];
                $genre=$_POST['movie_genre'];
                $intro=mysqli_real_escape_string($dbc,$_POST['movie_intro']);
                $storyline=mysqli_real_escape_string($dbc,$_POST['movie_storyline']);
                $poster = $_POST['movie_poster'];
                
                
                $url = $_POST['movie_trailerlink'];
                if(!empty($url))
                {
                    parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
                    $trailer = 'https://www.youtube.com/embed/'.$my_array_of_vars['v'];
                }

                $publishdate = $_POST['publish_date'];
                $problem = false;
                
                if(empty($moviename))
                {
                    $problem = true;
                    $movieerror = '<p class="error">Please enter a movie name!</p>';
                }
                if(empty($intro))
                {
                    $problem = true;
                    $introerror = '<p class="error">Please enter a movie intro!</p>';
                }
                if(empty($storyline))
                {
                    $problem = true;
                    $storylineerror = '<p class="error">Please enter a movie story line!</p>';
                }
                if(empty($poster))
                {
                    $problem = true;
                    $postererror = '<p class="error">Please enter a movie poster link!</p>';
                }
                if(empty($trailer))
                {
                    $problem = true;
                    $trailererror = '<p class="error">Please enter a movie trailer link!</p>';
                }
                if(empty($publishdate))
                {
                    $problem = true;
                    $publishdateerror = '<p class="error">Please enter a publish date!</p>';
                }
                if(!$problem)
                {                   
                    $insert = "INSERT INTO movie (movie_name, genre, intro, story_line, movie_poster, movie_trailer, publish_date) VALUES ('$moviename','$genre','$intro','$storyline','$poster','$trailer','$publishdate')";
                    $data= mysqli_query($dbc,$insert)or die(mysqli_connect_error());
                    if($data)
                    {
                       echo '<script>
                                alert("Movie successful uploaded!");                 
                                window.location.href="Movie_upload.php";
                              </script>';                                                                     
                    }
                }                               
           }
           include 'header.php';
        ?>
        
    <form class="form-horizontal" action="Movie_upload.php" method="POST">      
        <fieldset>   
          <div id="legend">
            <legend class="">Upload Movie</legend>
          </div>
            
            <div class="col-lg-12">
                
                <div class="col-lg-6 hei">
                    <div class="control-group">
                      <!-- Username -->
                      <label class="control-label">Movie Name</label>
                      <div class="controls">
                        <input type="text" name="movie_name" class="input-xlarge reg" value="<?php if(isset($_POST['movie_name'])){ echo htmlspecialchars($_POST['movie_name']);}?>"/>
                        <?php
                            if(!isset($movieerror))
                            {
                                echo '<p class="help-block">Enter movie name.</p>';
                            }
                            else
                            {
                                echo '<p class="error">'.$movieerror.'</p>';                   
                            }
                        ?>
                      </div>
                    </div>
                </div>
                
                <div class="col-lg-6 hei">
                    <div class="control-group">
                      <label class="control-label">Genres</label>
                      <div class="controls">
                          <select name="movie_genre" class="input-xlarge reg">
                              <option value="Action">Action</option>
                              <option value="Sci-fi">Sci-fi</option>
                              <option value="Romance">Romance</option>
                              <option value="Comedy">Comedy</option>
                              <option value="Horror">Horror</option>                           
                          </select>  
                          
                          <p class="help-block">Select movie genre.</p>
                      </div>                    
                    </div>
                </div>
                
                <div class="col-lg-6 hei">
                    <div class="control-group">
                    <label class="control-label">Intro</label>
                        <div class="controls">
                            <textarea name="movie_intro"><?php if(isset($_POST['movie_intro'])){ echo htmlspecialchars($_POST['movie_intro']);}?></textarea>                            
                            <?php
                                if(!isset($introerror))
                                {
                                    echo '<p class="help-block">Enter movie intro.</p>';
                                }
                                else
                                {
                                    echo '<p class="error">'.$introerror.'</p>';                   
                                }
                            ?>
                        </div>                     
                    </div>
                </div>
                
                <div class="col-lg-6 hei">
                    <div class="control-group">
                    <label class="control-label">Story line</label>
                        <div class="controls">
                            <textarea name="movie_storyline"><?php if(isset($_POST['movie_storyline'])){ echo htmlspecialchars($_POST['movie_storyline']);}?></textarea>                   
                            <?php
                                if(!isset($storylineerror))
                                {
                                    echo '<p class="help-block">Enter movie story line.</p>';
                                }
                                else
                                {
                                    echo '<p class="error">'.$storylineerror.'</p>';                   
                                }
                            ?>
                        </div>                                    
                    </div>
                </div>
                
                <div class="col-lg-6 hei">
                    <div class="control-group">
                        <label class="control-label">Movie Poster</label>
                        <div class="controls">
                            <input type="text" name="movie_poster" class="input-xlarge reg" value="<?php if(isset($_POST['movie_poster'])){ echo htmlspecialchars($_POST['movie_poster']);}?>">
                            <?php
                                if(!isset($postererror))
                                {
                                    echo '<p class="help-block">Enter movie poster link.</p>';
                                }
                                else
                                {
                                    echo '<p class="error">'.$postererror.'</p>';                   
                                }
                            ?>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6 hei">
                    <div class="control-group">
                        <label class="control-label">Movie Trailer</label>
                        <div class="controls">
                            <input type="text" name="movie_trailerlink" class="input-xlarge reg" value="<?php if(isset($_POST['movie_trailerlink'])){ echo htmlspecialchars($_POST['movie_trailerlink']);}?>">
                            <?php
                                if(!isset($trailererror))
                                {
                                    echo '<p class="help-block">Enter movie trailer link.</p>';
                                }
                                else
                                {
                                    echo '<p class="error">'.$trailererror.'</p>';                   
                                }
                            ?>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6 hei">
                    <div class="control-group">
                        <label class="control-label">Publish Date</label>
                        <div class="controls">
                            <input type="date" name="publish_date" class="input-xlarge reg" value="<?php if(isset($_POST['publish_date'])){ echo htmlspecialchars($_POST['publish_date']);}?>">
                            <?php
                                if(!isset($publishdateerror))
                                {
                                    echo '<p class="help-block">Select movie publish date.</p>';
                                }
                                else
                                {
                                    echo '<p class="error">'.$publishdateerror.'</p>';                   
                                }
                            ?>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-12">
                    <br>
                    <div class="control-group">
                    <!-- Button -->
                        <div class="controls">

                           <input type="hidden" name="submitted" value="true" />
                           <input class="btn btn-success" type="submit" name="submit" value="Upload"/>

                        </div>
                    </div>  
                </div>
          </div>
        </fieldset>
    </form>                                                                        
    
<?php
    include 'footer.php';
?>
