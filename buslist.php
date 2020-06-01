<?php
session_start();
include_once 'dbconnect.php';

?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Bus Traveling Community</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
        <link type="text/css" rel="stylesheet" href="css/bootstrap.css">
        <link type="text/css" rel="stylesheet" href="css/bootstrap-theme.min.css">
        <link type="text/css" rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">



         
    </head>
    <body>
        <!-- Header -->

        <div class="clearfix"></div>
        <!-- Navigation -->
        <div class="container-fluid navigation">
            <div class="container">
                <div class="col-sm-12 col-xs-6">
                    <div class="col-xs-12 col-sm-6">
                        <a href="home.php"><h1 class="title"><span class="fa fa-bus"></span> Bus Traveling Community</h1></a>
                    </div>
                    <div class="col-sm-3"></div>
                    <div class="col-xs-12 col-sm-3">
                        <nav>
                            <ul class="nav navbar-nav main_menu">
                                <li><a href="team.php">Team</a></li>
                                <li><a href="about.php">Contact</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-sm-12 hidden-xs">
                    <hr> 
                </div>
                <div class="col-sm-12 col-xs-6">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mainNavBar">
                            <span><i class="fa fa-align-justify fa-2x"></i></span>
                        </button>

                    </div>
                    <div class="col-sm-10 col-xs-12 collapse navbar-collapse" id="mainNavBar">
                        <nav role="navigation" id="uiu" >
                            <ul class="nav navbar-nav main_menu">
                                <li><a href="home.php">Home</a></li>
                                <li><a href="review.php">Search</a></li>
                                <li><a href="ticket.php">Ticket</a></li>
                                <li><a href="buslist.php">Bus Info</a></li>
                                <li><a href="about.php">About Us</a></li>
                                <li><a href="#" data-toggle="modal" data-target="#contribute">Share Your Experience</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-sm-2 col-xs-12 user">
                        <ul class="nav navbar-nav main_menu">
                            <li><a href="#"  class="dropdown-toggle" data-toggle="dropdown">
                                    <span class="fa fa-2x fa-user"><?php if(isset($_SESSION['user'])) echo $_SESSION['user']; ?></span><span class="caret fa-2x"></span></a>
                                <ul class="dropdown-menu">
                                    <?php
                                    echo "??";
                                        if(isset($_SESSION['id']))
                                        {
                                            echo "<li><a href='profile.php'><span class='text-success'>profile</span></a></li>";
                                            echo "<li><a href='logout.php'><span class='text-success'>Logout</span></a></li>";
                                        }
                                        else
                                        {
                                            echo "<li><a href='login.php'><span class='text-success'>Login</span></a></li>";
                                        }
                                    ?>
                                </ul>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>

        </div>

        <div class="container">
            <div class="col-sm-10 col-xs-10">
                    <div class="content text-center col-sm-12 col-xs-12">
                        <br/>
                        <h1>Bus Companies</h1>
                    </div>
            </div>
            
            <br><br>
            <?php 
            $sql = "SELECT * FROM bus_company ORDER BY rating DESC LIMIT 20";
            $res = $conn->query($sql);
            if($res->num_rows>0){
                while($ret = $res->fetch_assoc()){
                    $bname = $ret['bus_name'];
                    $rate = $ret['rating'];
            ?>
            <form  action="busprofile.php?bname=<?php echo $bname ?>" method="post">
            <div class="col-sm-12 col-xs-12">
               <div class="col-sm-3 col-xs-3">
               </div>
               <div class="col-sm-3 col-xs-3">
                  <h4><?php echo $bname ?></h4>
               </div>
               <div class="col-sm-3 col-xs-3">
                  <h4><?php echo "Rating: ",$rate ?></h4>
               </div>
               
               <div class="col-sm-3 col-xs-3">

               <button  class="btn-me" type="submit">Details</button>
               </div>
               
               <div class="col-sm-3 col-xs-3">
               </div>
            </div>
            </form>
            <?php
                }
            }
            ?>







        </div>






         <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
