<?php
    session_start();
    define('TITLE', 'Register');
    
    if(isset($_POST['submitted']))
    {
        $username=$_POST['reg_username'];
        $password=$_POST['reg_password'];
        $confirmpassword=$_POST['reg_confirmpassword'];
        $email=$_POST['reg_email'];
        $firstname = $_POST['reg_firstname'];
        $lastname = $_POST['reg_lastname'];
        $problem = false;
        
        if(empty($username))
        {
            $problem = true;
            $usererror = '<p class="error">Please enter your username!</p>';           
        }
        else if(!preg_match("/^[a-zA-Z0-9\S]{6,25}$/", $username))
        {
            $problem = true;            
            $usererror = '<p class="error">Please enter between 6 to 25 letter.</p>';
        }
        if(empty($password))
        {
            $problem = true;
            $passworderror = '<p class="error">Please enter a password!</p>';
        }
        else if(!preg_match("/^[a-zA-Z0-9\S]{6,35}$/",$password))
        {
            $problem = true;
            $passworderror = '<p class="error">Invalid password format or password not between 6 to 25 letter.</p>';
        }
        else if($password != $confirmpassword)
        {
            $problem = true;
            $confirm_passworderror = '<p class="error">You password did not match with your confirm password!</p>';
        }        
        if(empty($email))
        {
            $problem = true;
            $emailerror = '<p class="error">Please enter your email!</p>';
        }
        else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $problem = true;
            $emailerror = '<p class="error">invalid email format!</p>';
        }  
        
        if(empty($firstname))
        {
            $problem = true;
            $firstnameerror = '<p class="error">Please enter your first name!</p>';       
        }    
        else if(!preg_match("/^[a-zA-Z\S]*$/",$firstname))
        {
            $problem = true;
            $firstnameerror = '<p class="error">invalid first name format!</p>';
        }
        
        if(empty($lastname))
        {
            $problem = true;
            $lastnameerror = '<p class="error">Please enter your last name!</p>';
        }    
        else if(!preg_match("/^[a-zA-Z\S]*$/",$lastname))
        {
            $problem = true;
            $lastnameerror = '<p class="error">invalid last name format!</p>';
        }
        
        if(!$problem)
        {
            $lastcheck = false;
            $dbc=  mysqli_connect('localhost', 'root', '','movieviewer');
            
            $sql='SELECT username FROM user where username= "'.$username.'"';
            $res=  mysqli_query($dbc, $sql);
            if($res && mysqli_num_rows($res)>0)
            {
                echo '<p class="error">username had been taken!</p>';
                $lastcheck = true;
            }
            
            $sql2='SELECT email FROM user where email="'.$email.'"';
            $res2=mysqli_query($dbc, $sql2);
            if($res2 && mysqli_num_rows($res2)>0)
            {
                echo '<p class="error">email had been taken!</p>';
                $lastcheck = true;
            }
            
            if(!$lastcheck)
            {
                $register = "INSERT INTO user (username, email, password, first_name, last_name) VALUES ('$username','$email','$password','$firstname','$lastname')";
                $data= mysqli_query($dbc,$register)or die(mysqli_connect_error());
                if($data)
                {
                    $_SESSION['reg_username'] = $username;
                    header("location: register_redirect.php");
                    exit;
                }
            }
       }
            
    }
    require 'header.php';
?>
            
<form class="form-horizontal" action="register_page.php" method="POST">
  <fieldset>   
    <div id="legend">
      <legend class="">Register</legend>
    </div>
      <div class="col-lg-12">
        <div class="control-group">
          <!-- Username -->
          <label class="control-label"  for="username">Username</label>
          <div class="controls">
            <input type="text" name="reg_username" placeholder="" class="input-xlarge reg" value="<?php if(isset($_POST['reg_username'])){ echo htmlspecialchars($_POST['reg_username']);}?>">
            <?php
                if(!isset($usererror))
                {
                    echo '<p class="help-block">Username can contain any letters or numbers, without spaces</p>';
                }
                else
                {
                    echo '<p class="error">'.$usererror.'</p>';                   
                }
            ?>
          </div>
        </div>

        <div class="control-group">
          <!-- E-mail -->
          <label class="control-label" for="email">E-mail</label>
          <div class="controls">
            <input type="text" name="reg_email" placeholder="" class="input-xlarge reg" value="<?php if(isset($_POST['reg_email'])){ echo htmlspecialchars($_POST['reg_email']);}?>">        
            <?php
                if(!isset($emailerror))
                {
                    echo '<p class="help-block">Please provide your E-mail</p>';
                }
                else
                {
                    echo '<p class="error">'.$emailerror.'</p>';                   
                }
            ?>
          </div>
        </div>

        <div class="control-group">
          <!-- Password-->
          <label class="control-label" for="password">Password</label>
          <div class="controls">
            <input type="password" name="reg_password" placeholder="" class="input-xlarge reg">        
            <?php
                if(!isset($passworderror))
                {
                    echo '<p class="help-block">Password should be at least 6 characters</p>';
                }
                else
                {
                    echo '<p class="error">'.$passworderror.'</p>';                   
                }
            ?>
          </div>
        </div>

        <div class="control-group">
          <!-- Password -->
          <label class="control-label"  for="password_confirm">Password (Confirm)</label>
          <div class="controls">
            <input type="password" name="reg_confirmpassword" placeholder="" class="input-xlarge reg">
            <?php
                if(!isset($confirm_passworderror))
                {
                    echo '<p class="help-block">Please confirm password</p>';
                }
                else
                {
                    echo '<p class="error">'.$confirm_passworderror.'</p>';                   
                }
            ?>
          </div>
        </div>

        <div class="control-group">
          <!-- Username -->
          <label class="control-label"  for="First Name">First Name</label>
          <div class="controls">
            <input type="text" name="reg_firstname" placeholder="" class="input-xlarge reg" value="<?php if(isset($_POST['reg_firstname'])){ echo htmlspecialchars($_POST['reg_firstname']);}?>">
            <?php
                if(!isset($firstnameerror))
                {
                    echo '<p class="help-block">First name can contain any letters, without spaces and numbers</p>';
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
            <input type="text" name="reg_lastname" placeholder="" class="input-xlarge reg" value="<?php if(isset($_POST['reg_lastname'])){ echo htmlspecialchars($_POST['reg_lastname']);}?>">
            <?php
                if(!isset($lastnameerror))
                {
                    echo '<p class="help-block">Last name can contain any letters, without spaces and numbers</p>';
                }
                else
                {
                    echo '<p class="error">'.$lastnameerror.'</p>';                   
                }
            ?>
          </div>
        </div>  

        <div class="control-group">
          <!-- Button -->
          <div class="controls">
             <input type="hidden" name="submitted" value="true" />
             <input class="btn btn-success" type="submit" name="submit" value="Register"/>       

          </div>
        </div>
            <br><p>Already Registered? <a href="login_page.php">Login here!</a></p>
    </div>
  </fieldset>
</form>
       
<?php
    require 'footer.php';

?>