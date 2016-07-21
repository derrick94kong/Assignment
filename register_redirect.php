<?php
    session_start();
    require 'header.php';

?>
<div class="min-height">
    <div class="container">
        <p>You will redirected to login page in <span id="counter">5</span> second(s).</p>
        <p><a href="login_page.php">If not redirect, click here.</a></p>
        <script type="text/javascript">
        function countdown() {
            var i = document.getElementById('counter');
            if (parseInt(i.innerHTML)<=1) {
                location.href = 'login_page.php';
            }
            i.innerHTML = parseInt(i.innerHTML)-1;
        }
        setInterval(function(){ countdown(); },1000);
        </script>
    </div>
</div>
        
        
 <?php
    
    require 'footer.php';

?>