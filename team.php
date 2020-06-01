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
        
        <script src="http://s.codepen.io/assets/libs/modernizr.js" type="text/javascript"></script>

        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

  


         
    </head>
    <body>




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
                                <li><a href="about.html">Contact</a></li>
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
                                <li><a href="#">Search</a></li>
                                <li><a href="ticket.html">Ticket</a></li>
                                <li><a href="buslist.php">Bus Info</a></li>
                                <li><a href="about.html">About Us</a></li>
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
        <br><br>
                <font size=6><p style="text-align:center"><b>Project Contribution</b></p></font>
                <div class="container-fluid">
                    <div class="container">
                        
                        
                            <br>

                            <hr>
                            <div class="col-sm-6 col-xs-12">
                                <div class="col-sm-12 col-xs-12">
                                    <h4 class="col-sm-offset-2 hd">Mumtahina</h4>
                                    <img src="images/tahina.jpg" class="img-thumbnail" alt="Profile Picture" width="304" height="236">
                                </div>
                               
                                </br>


                            </div>
                            <div class="col-sm-6 col-xs-12">
                                
                                <br><br><br><br>
                                <font size=5><h><b>Web design/Diagrams</b></h></font>
                            </div>
                        </div>


                    </div>
                </div>

                <div class="container-fluid">
                    <div class="container">
                        
                        
                            <br>

                            <hr>
                            <div class="col-sm-6 col-xs-12">
                                <div class="col-sm-12 col-xs-12">
                                    <h4 class="col-sm-offset-2 hd">Rakibul Hossain</h4>
                                    <img src="images/riyad.jpg" class="img-thumbnail" alt="Profile Picture" width="304" height="236">
                                </div>
                               
                                </br>


                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <br><br><br><br>
                                <font size=5><h><b>Backend/Database/Mockups/Diagrams</h></b></font>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="container-fluid">
                    <div class="container">
                        
                        
                            <br>

                            <hr>
                            <div class="col-sm-6 col-xs-12">
                                <div class="col-sm-12 col-xs-12">
                                    <h4 class="col-sm-offset-2 hd">Mushfiqur Rahman</h4>
                                    <img src="images/mushi.jpg" class="img-thumbnail" alt="Profile Picture" width="304" height="236">
                                </div>
                               
                                </br>


                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <br><br><br><br>
                                <font size=5><h><b>Backend/Database/Mockups/ERD</b></h></font>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="container-fluid">
                    <div class="container">
                        
                        
                            <br>

                            <hr>
                            <div class="col-sm-6 col-xs-12">
                                <div class="col-sm-12 col-xs-12">
                                    <h4 class="col-sm-offset-1 hd">Mohammad Shahriar Reza</h4>
                                    <img src="images/reza.jpg" class="img-thumbnail" alt="Profile Picture" width="304" height="236">
                                </div>
                               
                                </br>


                            </div>
                            <div class="col-sm-6 col-xs-12">
                                 
                                <br><br><br><br>
                                <font size=5><h><b>Diagrams/Mockups/Documentation</b></h></font>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="container-fluid">
                    <div class="container">
                        
                        
                            <br>

                            <hr>
                            <div class="col-sm-6 col-xs-12">
                                <div class="col-sm-12 col-xs-12">
                                    <h4 class="col-sm-offset-2 hd">Samrin Ahmed Riya</h4>
                                    <img src="images/riya.jpg" class="img-thumbnail" alt="Profile Picture" width="304" height="236">
                                </div>
                               
                                </br>


                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <br><br><br><br>
                                <font size=5><h><b>Documentation/Diagrams</b></h></font>
                            </div>
                        </div>


                    </div>
                </div>


                
                </br></br>






    <div class="container-fluid footer">
                <div class="col-sm-12 col-xs-12">
                    <div class="col-sm-4 footer_part1">
                        <h1><i>BTc</i></h1>
                        <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.</p>
                        <br>
                        <a href="#"><span class="fa fa-2x fa-facebook"></span></a><a href="#"><span class="fa fa-2x fa-twitter"></span></a><a href="#"><span class="fa fa-2x fa-linkedin"></span></a>
                    </div>
                    <div class="col-sm-4 footer_part2">
                        <div class="col-sm-6"></div>
                        <div class="col-sm-6">
                            <h4>Management</h4>
                            <nav class="footer_nav">
                                <ul class="nav nav-stacked">
                                    <li><a href="#">Resources</a></li>
                                    <li><a href="#">Institutions</a></li>
                                    <li><a href="#">Locations</a></li>
                                    <li><a href="#">Contact</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-sm-3 footer_part3">
                        <p class="text-center">btc inc @2017</p>
                    </div>
                    <div class="col-sm-offset-1 go_top">
                        <a href="#" class="back_to_top"> <span class="fa fa-2x fa-arrow-up"></span> </a>
                    </div>
                </div>
            </div>


            <div class="container">
            <div class="col-sm-12">
                <div class="modal" id="contribute">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="text-center">Your Review!!</h1>
                            </div>
                            <div class="modal-body">
                                
                             <div class="form-group">
                             <label><b>Starting Location</b></label>
                             <input type="text" placeholder="Enter Starting Location" name="uname" class="form-control" required="">
                             <br>
                              <label><b>Ending Location</b></label>
                             <input type="text" placeholder="Enter Ending Location" name="uname" class="form-control" required="">
                             <br>
                              <label><b>Bus Name</b></label>
                             <input type="text" placeholder="Enter Bus Name" name="uname" class="form-control" required="">
                             <br>
                              <label><b>Fare</b></label>
                             <input type="text" placeholder="Enter Fare" name="uname" class="form-control" required="">
                             <br>
                             <label> Review </label>
                                        <textarea rows="5" class="form-control" name="message" placeholder="Review" required=""></textarea>
                                        <br>
                                     <div class="col-sm-12 col-xs-12">
                                       <div class="col-sm-2 col-xs-2">
                                     <label class="for_rating"><b>Rating</b></label>
                                       </div>
                                       <div class="col-sm-8 col-xs-8">
                                        <div class="rate">

                                           <input type="radio" id="star5" name="rate" value="5" />

                                           <label for="star5" title="text">5 stars</label>

                                           <input type="radio" id="star4" name="rate" value="4" />

                                           <label for="star4" title="text">4 stars</label>

                                           <input type="radio" id="star3" name="rate" value="3" />

                                           <label for="star3" title="text">3 stars</label>

                                           <input type="radio" id="star2" name="rate" value="2" />

                                           <label for="star2" title="text">2 stars</label>

                                           <input type="radio" id="star1" name="rate" value="1" />

                                           <label for="star1" title="text">1 star</label>

                                         </div>
                                         </div>
                                         <div class="col-sm-2 col-xs-2">
                                         </div>
                                     </div>
                                     </div>




                                   <br><br>
                                  <button class="btn-me" type="submit">Submit</button>
                             
                        </div>

                             <div class="form-group" style="background-color:#f1f1f1">
                              <button  type="button" data-dismiss="modal" class="cancelbtn">Cancel</button>
                             
                            </div>

                           </form>

                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>





     <script src="js/jquery-1.11.3.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script>
            $(function () {
                $(".popcorn").popover({html: true});
            });
            $('[data-spy="scroll"]').each(function () {
                var $spy = $(this).scrollspy('refresh');
            });

            /* Start Back to top*/
            $(document).ready(function () {
                var btt = $('.back_to_top');
                btt.on('click', function (e) {
                    $('html,body').animate({
                        scrollTop: 0
                    }, 1000);
                    e.preventDefault();
                });
                $(window).on('scroll', function () {
                    var self = $(this),
                            height = self.height(),
                            top = self.scrollTop();
                    if (top > 200) {
                        if (!btt.is(':visible')) {
                            btt.show();
                        }
                    } else {
                        btt.hide();
                    }
                });
            });

            $(function () {
                $("#datepicker").datepicker();
            });
            $(function () {
                $("#datepicker2").datepicker();
            });
        </script>
        <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    </body>
</html>