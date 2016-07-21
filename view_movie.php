<?php
    session_start();
    include_once 'database_connection.php'; 
   
    $movie_id = $_GET['movie_id'];
    
    $query = "SELECT movie_name FROM movie WHERE id='$movie_id'";
    $movie_result = mysqli_query($dbc, $query);
    $name = mysqli_fetch_assoc($movie_result);   
    $movie_name = $name['movie_name'];
    define('TITLE', $movie_name);
    
       
    require 'header.php';             
?>
            <div class="row col-lg-12">
<?php
            
            if(!empty($movie_id))
            {                                
                $sql = "SELECT * FROM movie WHERE id = '$movie_id'";
                $row=$dbc->query($sql);
                $rows = $row->fetch_assoc();
                $result=mysqli_query($dbc,$sql);
                $rows = mysqli_fetch_array($result,MYSQLI_ASSOC);

                
                echo '  
                        <div class="col-lg-12">
                            <h2 class="page-header">
                               '.$rows['movie_name'].'
                            </h2>                
                        </div>
                            
                                
                        <div class="col-md-4 poster">
                          <div class="review_container">      
                              <img src="'.$rows['movie_poster'].'">
                          </div>
                        </div>
                        <div class="col-md-8"> 
                            <h3 class="page-header" style="margin-top:20px;">
                               Intro
                            </h3> 
                            <h4>'.$rows['intro'].'</h4>
                            <table>  
                                <tr>
                                    <th><h4 align="right" style="padding: 20px 0 20px 0;width:120px;">Movie Genre : </h4></t/>
                                    <th><h4 style="padding-left :10px;">'.$rows['genre'].'</h4></th>
                                </tr>   
                                <tr>
                                    <th><h4 align="right" style="padding: 20px 0 20px 0;width:120px;align: right;">Publish Date : </h4></th>
                                    <th><h4 style="padding-left :10px;">'.$rows['publish_date'].'</h4></th>
                                </tr>
                            </table>
                        </div>                       

                        <div class="col-lg-12">
                            <h3 class="page-header">
                               Story Line
                            </h3>     
                            <h4>'.$rows['story_line'].'</h4>
                        </div> ';                                 
                
                echo '<div class="col-lg-12">
                        <h3 class="page-header">
                            Trailer
                         </h3>
                        <iframe width="100%" height="500px" src='.$rows['movie_trailer'].'></iframe>                       
                      </div>';
            }
            else
            {
                header('location: home_page.php');
            }                       
    
    //------------------------------------------------------------------------------------------------------------------            
    
    echo '<div class="col-lg-12">
                <h3 class="page-header">User Comment</h3>';    
    
        foreach ($dbc->query("SELECT * FROM movie_comment WHERE movie_id = '$movie_id' ORDER BY id") as $rows1)
        {
            $user_id = $rows1['user_id'];
            $getname = "SELECT * FROM user WHERE id = '$user_id' ";                          
            $result1=mysqli_query($dbc,$getname);
            $rows2=mysqli_fetch_array($result1,MYSQLI_ASSOC);

            $user_name = $rows2['first_name'] .' '. $rows2['last_name'].'</br>';
            
            if(!(isset($_SESSION['user_id']) && $_SESSION['user_id'] != ''))
            {
                $login_userid = "0";
            }
            else
            {
                $login_userid = $_SESSION['user_id'];
            }
            
            echo '<div class="col-lg-12">';
            
            if($user_id == $login_userid)
            {                  
                $delete_comment = '<a style="float:right;" href="delete_comment.php?comment_id='.$rows1["id"].'&movie_id='.$movie_id.'">Delete</a>';
            }

        echo '               
                <div class="col-lg-12" style="padding-top:15px ;padding-bottom: 15px;">
                    <div class="col-sm-2">
                        <div class="thumbnail">
                            <img class="img-responsive user-photo" src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png">
                        </div><!-- /thumbnail -->
                    </div><!-- /col-sm-1 -->

                    <div class="col-sm-10">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <strong>'.$user_name.'</strong>';
                    
                    if(isset($delete_comment))
                    {
                        echo $delete_comment;
                    }
                        
                    echo '</div>
                            <div class="panel-body">
                            '.$rows1['comment'].'
                            </div><!-- /panel-body -->
                        </div><!-- /panel panel-default -->
                    </div><!-- /col-sm-5 -->
                </div>                         
            </div>
        ';                 
        }        
                
                           
    ?>
                 
        <div class="col-lg-12">
             <h3 class="page-header">Your Comment</h3>
                               
                           
             <form action="<?php echo 'comment_movie.php?movie_id='.$movie_id.'';?>" method="POST">
                
                <textarea class="form-control" name="user_comment" placeholder="write your comment here."></textarea>
                 
               <input type="hidden" name="submitted" value="true" />
               <br>
               <p><input class="btn btn-default" type="submit" name="submit" value="Comment"/></p>
           </form>
        </div>
    </div>

</div>

<?php

    require 'footer.php';

?>
