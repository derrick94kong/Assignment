<?php
    session_start();
    session_destroy();
    $_SESSION['loginvalidate'] = '';
    header("location:login_page.php");
?>