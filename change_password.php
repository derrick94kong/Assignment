  
        <?php            
            session_start();
            define('TITLE', 'Change Password');
            
            include_once 'database_connection.php';
            
            if(!isset($_SESSION['loginvalidate']))
            {
                header("location:login_page.php");
            }
                            
            if(isset($_POST['submitted']))
            { 
               
                   $user_id = $_SESSION['user_id'];
                   $sql = "SELECT * FROM user WHERE id = '$user_id'";
                   $result=mysqli_query($dbc,$sql);
                   $rows = mysqli_fetch_array($result,MYSQLI_ASSOC);
                   
                   $origin_password = $rows['password'];
                   
                   $old_pass = $_POST['old_pass'];
                   $new_pass = $_POST['new_pass'];
                   $confirm_newpass = $_POST['confirm_newpass'];
                   $problem = false;
                   
                   if(empty($old_pass))
                    {
                        $problem = true;
                        $passerror = '<p class="error">Please enter your old password!</p>';
                    }
                    else if($old_pass != $origin_password)
                    {
                        $problem = true;
                        $passerror = '<p class="error">Please enter correct old password!</p>';
                    }
                    else if(empty($new_pass))
                    {
                        $problem = true;
                        $passerror = '<p class="error">Please enter your new password!</p>';
                    }
                    else if(!preg_match("/^[a-zA-Z0-9\S]{6,35}$/",$new_pass))
                    {
                        $problem = true;
                        $passerror = '<p class="error">Invalid new password format.</p>';
                    }
                    else if($new_pass != $confirm_newpass)
                    {
                        $problem = true;
                        $passerror = '<p class="error">You new password did not match with your confirm new password!</p>';
                    }
                    
                    if(!$problem)
                    {
                        $update_password = "UPDATE user SET password = '$new_pass' WHERE id = '$user_id'";
                        $data= mysqli_query($dbc,$update_password)or die(mysqli_connect_error());
                        if($data)
                        {
                            echo '<script>
                                  alert("Password changed!");
                                  window.location.href="login_page.php";
                                  </script>';       
                        }
                    }
            }
        require 'header.php';
 ?>       
              
    <form class="form-horizontal" action="change_password.php" method="post">      
        <fieldset>   
          <div id="legend">
            <legend class="">Change Password</legend>
          </div>
            
            <div class="col-lg-12">
              <div class="control-group">
                <!-- Username -->
                <label class="control-label"  for="username">Old Password</label>
                <div class="controls">
                  <input type="password" name="old_pass" class="input-xlarge reg"/>                      
                </div>
              </div>

              <div class="control-group">
                <!-- E-mail -->
                <label class="control-label" for="password">New Password</label>
                <div class="controls">
                  <input type="password" name="new_pass" class="input-xlarge reg"/>                              
                </div>                    
              </div>
                
                <div class="control-group">
                <!-- E-mail -->
                <label class="control-label" for="password">Confirm New Password</label>
                <div class="controls">
                  <input type="password" name="confirm_newpass" class="input-xlarge reg"/>                              
                </div> 
                    <?php
                          if(isset($passerror)) 
                          {
                              echo '<br><p class="error">'.$passerror.'</p>';                   
                          }
                    ?>
                </div><br>

                <div class="control-group">
                <!-- Button -->
                    <div class="controls">

                       <input type="hidden" name="submitted" value="true" />
                       <input class="btn btn-success" type="submit" name="submit" value="Change" />

                    </div>
                </div>                      
          </div>
        </fieldset>
    </form>


<?php       
        require 'footer.php';
?>
   