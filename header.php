<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>
            <?php   
                if(defined('TITLE'))
                {
                    echo TITLE;
                }
                else
                {
                    echo "Welcome To MovieViewer";
                }
            ?>
        </title>
        
        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="css/modern-business.css" rel="stylesheet">
        
        <!-- Search Bar CSS -->
        <link href="css/searchbar.css" rel="stylesheet" type="text/css">

        <!-- Custom Fonts -->
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        
        <style type="text/css" media="screen">
            .error {color : red ;}
        </style>
        

    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="home_page.php">MovieViewer</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    
                    <!-- search bar -->
                    <li style="padding-top:10px;padding-right: 5px; height: 37px; ">
                        <form action="home_page.php" class="search-form" method="post">
                            <div class="form-group has-feedback">
                                    <label for="search" class="sr-only">Search</label>
                                    <input type="text" class="form-control" name="search" id="search" placeholder="search movie...">
                                    <span class="glyphicon glyphicon-search form-control-feedback "></span>
                            </div>
                        </form>
                        
                        <?php
                            if(isset($_POST['search']))
                            {   
                                $search = $_POST['search'];
                                $search_movie = "search_movie.php?search=$search";
                                header("location: $search_movie");
                            }
                        ?>
                        
                    </li>                                              
                    <li>
                        <a href="home_page.php">Home</a>
                    </li>                                        
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Movie <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="Movie_list.php">Movie List(A-Z)</a>
                            </li>
                            
                            <li>
                                <a href="latest_movie.php">Lastest Movie</a>
                            </li>
                            
                            <li>
                                <a href="Movie_genre.php">Movie Genre</a>
                            </li>
                            <?php
                            
                                if(isset($_SESSION['level']) && $_SESSION['level'] == 2)
                                {
                                    echo '<li>
                                          <a href="Movie_upload.php">Upload Movie</a>
                                          </li>';
                                }
                            
                            ?>
                            
                        </ul>
                    </li>
                    <?php
                        if(!isset($_SESSION['loginvalidate']))
                        {                           
                            echo '<li>
                                <a href="register_page.php">Sign Up</a>
                            </li>
                            <li>
                                <a href="login_page.php">Log In</a>
                            </li>'; 
                        } 
                        else
                        {
                            echo '<li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">'.$_SESSION['firstname'].' <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="change_profile.php">Change Profile</a>
                                        </li>
                                        <li>
                                            <a href="change_password.php">Change Password</a>
                                        </li>
                                        <li>
                                            <a href="logout.php">Logout</a>
                                        </li>
                                    </ul>
                                </li>';
                        }
                    ?>                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->        
    </nav>
        
<div class="container" style="margin-top: 20px">
    <div class="min-height">