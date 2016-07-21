<?php
    session_start();
    require 'header.php';
    
    echo '<div class="min-height">';
    if($_SESSION['level'] == 2)
    {
        echo '<p>Hi, admin '.$_SESSION["firstname"].' '.$_SESSION["lastname"].'.</p>';
    }
    else 
    {
        echo '<p>Hi, '.$_SESSION["firstname"].' '.$_SESSION["lastname"].'.</p>';
    }   
?>
        <p>You will redirected to home page in <span id="counter">5</span> second(s).</p>
        <p><a href="home_page.php">If not redirect, click here.</a></p>
        <script type="text/javascript">
        function countdown() {
            var i = document.getElementById('counter');
            if (parseInt(i.innerHTML)<=1) {
                location.href = 'home_page.php';
            }
            i.innerHTML = parseInt(i.innerHTML)-1;
        }
        setInterval(function(){ countdown(); },1000);
        </script>
    </div>
       
 <?php 
     require 'footer.php';
?>
