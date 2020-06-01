
<?php

    session_start();
    include_once 'dbconnect.php';


$TMPname        = $_POST['tmpname'];
$TMPemail       = $_POST['tmpemail'];
$TMPmobile      = $_POST['tmpmobile']  ;
$TMPgender      = $_POST['tmpgender'];
$TMPdate        = $_POST['tmpdate'];
$TMPsource      = $_POST['tmpsource'];
$TMPdestination = $_POST['tmpdestination'];
$TMPtotal       = $_POST['tmptotal'];
$TMPdeptTime    = $_POST['tmpdeptTime'];
$TMParrTime     = $_POST['tmparrTime'];
$TMPtype        = $_POST['tmptype'];
$TMPbusName     = $_POST['tmpbusName'];


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
                                <li><a href="#">Team</a></li>
                                <li><a href="#contact">Contact</a></li>
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
                                <li><a href="about.html">About Us</a></li>
                                
                            </ul>
                        </nav>
                    </div>
                    <div class="col-sm-2 col-xs-12 user">
                        <ul class="nav navbar-nav main_menu">
                          
                            <li><a href="#"  class="dropdown-toggle" data-toggle="dropdown">
                                    <span class="fa fa-2x fa-user"><?php if(isset($_SESSION['user'])) echo $_SESSION['user']; ?></span><span class="caret fa-2x"></span></a>
                                <ul class="dropdown-menu">
                                    <?php
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
        <div  class="col-sm-12 col-xs-12"><hr></div>
                  
                    <div class="content col-sm-12 col-xs-12">
                        <br/>
                        <div class="col-sm-12 col-xs-12">
                            <div class="col-sm-8 col-xs-8">
                              <h2>Online Reservation</h2>
                            </div>
                            <div class="col-sm-2 col-xs-6">
                                <h2>#Ticket</h2>
                            </div>
                            
                        </div>

                          <div class="col-sm-12 hidden-xs">
                          <hr> 
                          </div>


                        <div class="col-sm-12 col-xs-12">
                        <div class="col-sm-4 col-xs-6">
                               
                                <?php echo " <p><b>Name:</b> $TMPname</p>" ?>
                            </div>
                            <div class="col-sm-4 col-xs-6">
                                <?php echo "<p><b>Gender:</b>$TMPgender</p>" ?>
                            </div>
                            
                            <div class="col-sm-4 col-xs-6">
                                <?php echo "<p><b>Mobile:</b>$TMPmobile</p>" ?>
                                
                            </div>

                            
                        </div>



                        <div class="col-sm-12 col-xs-12">
                            <div class="col-sm-4 col-xs-6">
                              <?php  echo"<p><b>Travel Date:</b> $TMPdate</p>" ?>
                                
                            </div>
                            <div class="col-sm-4 col-xs-6">
                                <?php echo "<p><b>Departure Time:</b> $TMPdeptTime</p>" ?>
                            
                                
                            </div>
                            
                            <div class="col-sm-4 col-xs-6">
                                
                                <?php echo "<p><b>Arrival Time:</b> $TMParrTime</p>" ?>
                            </div>

                            
                        </div>

                        <div class="col-sm-12 col-xs-12">
                        <div class="col-sm-4 col-xs-6">
                                
                            <?php echo "<p><b>Bus Name:</b> $TMPbusName</p>" ?>
                                
                            </div>
                            <div class="col-sm-4 col-xs-6">
                                
                            <?php echo "<p><b>Destination:</b> $TMPdestination</p>" ?>
                            </div>
                            
                            <div class="col-sm-4 col-xs-6">
                                
                                <?php echo "<p><b>Type :</b> $TMPtype</p>" ?>
                                
                                
                            </div>

                            
                        </div>

                        <div class="col-sm-12 col-xs-12">
                        <div class="col-sm-4 col-xs-6">
                                
                                <?php echo "<p><b>Departure Place :</b> $TMPsource</p>" ?>
                            </div>
                            
                            
                            <div class="col-sm-4 col-xs-6">
                                
                                <?php echo "<p><b>Total:</b> bdt $TMPtotal</p>" ?>
                            </div>

                            
                        </div>
                        
                         <div class="col-sm-12 col-xs-12">
                        <div class="col-sm-4 col-xs-6">
                                
                                
                            </div>
                            <div class="col-sm-4 col-xs-6">
                                
                            </div>
                            
                            <div class="col-sm-4 col-xs-6">
                                                                
                            </div>

                            
                        </div>
                         <div class="col-sm-12 col-xs-12">
                         <div class="col-sm-4 col-xs-6">
                               
                            </div>
                            <div class="col-sm-4 col-xs-6">
                           <h3>Thank You For Purchasing</h3>
                           </div>
                            <div class="col-sm-4 col-xs-6">
                                
                                
                            </div>
                        </div>

                    </div>
                    </div>



           <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
