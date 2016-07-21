<?php 
    session_start();   
    define('TITLE', 'Login');
    
    include_once 'database_connection.php';
    
    if(isset($_SESSION['loginvalidate']))
    {
        header("location:home_page.php");
    }
      
    if(isset($_POST['submitted']))
    {
        if((!empty($_POST['username'])) && (!empty($_POST['password'])))   
        {          
            $username = mysqli_real_escape_string($dbc,$_POST['username']);
            $password = mysqli_real_escape_string($dbc,$_POST['password']);

            $sql = 'SELECT * FROM user WHERE username = "'.$username.'" and password = '.$password;

            $row=$dbc->query($sql);
            $rows = $row->fetch_assoc();
            $result=mysqli_query($dbc,$sql);
            $rows = mysqli_fetch_array($result,MYSQLI_ASSOC);
            $count = mysqli_num_rows($result);
            if($count == 1) 
            {              
                 $_SESSION['firstname'] = $rows['first_name'];
                 $_SESSION['lastname'] = $rows['last_name'];
                 $_SESSION['email'] = $rows['email'];
                 $_SESSION['user_id'] = $rows['id'];
                 $_SESSION['level'] = $rows['level'];
                 $_SESSION['loginvalidate'] = true;

                 if($rows['level']==1)
                 {                                      
                    header("location:login_redirect.php");
                    exit;
                 }
                 else if ($rows['level']==2)
                 {
                    header("location:login_redirect.php"); 
                    exit;
                 }
                 else
                 {
                    header("location:error.php");
                    exit;
                 }
            }
            else
            {
                 $loginerror = "Invalid username or password";                    
            }
            mysqli_close($dbc);
        }
        else
        {       
            $loginerror = "Please enter your username or password";      
        }
    }
    
    require 'header.php';       

?>  

        <form class="form-horizontal" action="" method="post">      
            <fieldset>   
              <div id="legend">
                <legend class="">Login</legend>
              </div>
                <div class="col-lg-12">
                  <div class="control-group">
                    <!-- Username -->
                    <label class="control-label"  for="username">Username</label>
                    <div class="controls">
                      <input type="text" name="username" class="input-xlarge reg" size="20" value="<?php if(isset($_SESSION['reg_username'])){echo htmlspecialchars($_SESSION['reg_username']);}else if(isset($_POST['username'])){ echo htmlspecialchars($_POST['username']);}?>"/>                      
                    </div>
                  </div>

                  <div class="control-group">
                    <!-- E-mail -->
                    <label class="control-label" for="password">Password</label>
                    <div class="controls">
                      <input type="password" name="password" placeholder="" class="input-xlarge reg">                              
                    </div> 
                        <?php
                              if(isset($loginerror)) 
                              {
                                  echo '<br><p class="error">'.$loginerror.'</p>';                   
                              }
                        ?>
                  </div><br>                 
                    
                  <div class="control-group">
                    <!-- Button -->
                    <div class="controls">
                       
                       <input type="hidden" name="submitted" value="true" />
                       <input class="btn btn-success" type="submit" name="submit" value="Login" />
                                                       
                    </div>
                  </div>                      
              </div>
            </fieldset>
        </form>   

<?php 
    require 'footer.php';
?>
