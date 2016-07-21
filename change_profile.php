  
        <?php            
            session_start();
            define('TITLE', 'Change Profile');
            
            include_once 'database_connection.php';
            
            if(!isset($_SESSION['loginvalidate']))
            {
                header("location:login_page.php");
            }
            
            if(isset($_SESSION['email']))
            { 
                $new_email = $_SESSION['email'];
            }
            if(isset($_SESSION['firstname']))
            { 
                $new_firstname = $_SESSION['firstname'];
            }
            if(isset($_SESSION['lastname']))
            { 
                $new_lastname = $_SESSION['lastname'];
            }
                            
            if(isset($_POST['submitted']))
            {               
                   
                   
                   $new_email = $_POST['new_email'];
                   $new_firstname = $_POST['new_firstname'];
                   $new_lastname = $_POST['new_lastname'];
                   $user_id = $_SESSION['user_id'];
                   $problem = false;
                                                                       
                    if(empty($new_email))
                    {
                        $problem = true;
                        $emailerror = '<p class="error">Please enter your new email!</p>';
                    }
                    else if(!filter_var($new_email, FILTER_VALIDATE_EMAIL))
                    {
                        $problem = true;
                        $emailerror = '<p class="error">invalid email format!</p>';
                    }
                    if(empty($new_firstname))
                    {
                        $problem = true;
                        $firstnameerror = '<p class="error">Please enter your new first name!</p>';       
                    }    
                    else if(!preg_match("/^[a-zA-Z\S]*$/",$new_firstname))
                    {
                        $problem = true;
                        $firstnameerror = '<p class="error">invalid first name format!</p>';
                    }
                    if(empty($new_lastname))
                    {
                        $problem = true;
                        $lastnameerror = '<p class="error">Please enter your last name!</p>';
                    }    
                    else if(!preg_match("/^[a-zA-Z\S]*$/",$new_lastname))
                    {
                        $problem = true;
                        $lastnameerror = '<p class="error">invalid last name format!</p>';
                    }
                   
                    if(!$problem)
                    {
                        $update_password = "UPDATE user SET email='$new_email', first_name='$new_firstname', last_name='$new_lastname' WHERE id ='$user_id'";
                        $data= mysqli_query($dbc,$update_password)or die(mysqli_connect_error());
                        if($data)
                        {
                            $_SESSION['firstname'] = $new_firstname;
                            $_SESSION['lastname'] = $new_lastname;
                            $_SESSION['email'] = $new_email;
                            echo '<script>
                                  alert("Profile changed!");
                                  window.location.href="home_page.php";
                                  </script>';       
                        }
                    }
            }
        require 'header.php';
 ?>       
              
    <form class="form-horizontal" action="change_profile.php" method="post">      
        <fieldset>   
          <div id="legend">
            <legend class="">Change Profile</legend>
          </div>
            <p class="help-block">*Leave it if nothing to change.</p>
            
            <div class="col-lg-12">
              <div class="control-group">
          <!-- E-mail -->
                <label class="control-label" for="email">E-mail</label>
                <div class="controls">
                  <input type="text" name="new_email" class="input-xlarge reg" value="<?php if(isset($new_email)){ echo htmlspecialchars($new_email);}?>">        
                  <?php
                      if(!isset($emailerror))
                      {
                          echo '<p class="help-block">Please provide your new e-mail.</p>';
                      }
                      else
                      {
                          echo '<p class="error">'.$emailerror.'</p>';                   
                      }
                  ?>
                </div>
              </div>

                <div class="control-group">
                    <!-- Username -->
                    <label class="control-label"  for="First Name">First Name</label>
                    <div class="controls">
                      <input type="text" name="new_firstname" placeholder="" class="input-xlarge reg" value="<?php if(isset($new_firstname)){ echo htmlspecialchars($new_firstname);}?>">
                      <?php
                          if(!isset($firstnameerror))
                          {
                              echo '<p class="help-block">Please provide your new first name with contain any letters, without spaces and numbers.</p>';
                          }
                          else
                          {
                              echo '<p class="error">'.$firstnameerror.'</p>';                   
                          }
                      ?>
                    </div>
                  </div>
                
                  <div class="control-group">
                    <!-- Username -->
                    <label class="control-label"  for="Last Name">Last Name</label>
                    <div class="controls">
                      <input type="text" name="new_lastname" placeholder="" class="input-xlarge reg" value="<?php if(isset($new_lastname)){ echo htmlspecialchars($new_lastname);}?>">
                      <?php
                          if(!isset($lastnameerror))
                          {
                              echo '<p class="help-block">Please provide your new last name with contain any letters, without spaces and numbers.</p>';
                          }
                          else
                          {
                              echo '<p class="error">'.$lastnameerror.'</p>';                   
                          }
                      ?>
                    </div>
                  </div>  <br>

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
   