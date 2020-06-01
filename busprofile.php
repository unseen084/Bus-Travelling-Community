<?php
session_start();
include_once 'dbconnect.php';
$bname=0;
if(isset($_POST['bname'])) $bname = $_GET['bname'];

?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Bus Profile</title>
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
                        <a href="home.php"><h1 class="title"><span class="fa fa-bus"></span> Bus Traveling Community </h1></a>
                    </div>
                    <div class="col-sm-3"></div>
                    <div class="col-xs-12 col-sm-3">
                        <nav>
                            <ul class="nav navbar-nav main_menu">
                                <li><a href="team.php">Team</a></li>
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
                                <li><a href="review.php">Search</a></li>
                                <li><a href="ticket.php">Ticket</a></li>
                                <li><a href="busprofile.php">Bus Info</a></li>
                                <li><a href="about.html">About Us</a></li>
                                <li><a href="#" data-toggle="modal" data-target="#contribute">Share Your Experience</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-sm-2 col-xs-12 user">
                        <ul class="nav navbar-nav main_menu">
                            <li class="f_right"><a href="#"><span class="fa fa-2x fa-question"></span></a></li>
                            <li><a href="#"  class="dropdown-toggle" data-toggle="dropdown">
                                    <span class="fa fa-2x fa-user"></span><span class="caret fa-2x"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="login.php"><span class="text-success">Login</span></a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
        <div class="clearfix"></div>
        <!-- Navigation -->
        
            <div class="container-fluid fullwidth_back_bp text-center">
            	<h2 class="text-uppercase search_h1">Search Shohag Paraibahan Deals</h2>
                <div class="col-xs-12 col-sm-12 search">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-10">
                        <form class="form-inline" method="post">
                            <input  class="form-control" placeholder="From: address or city" name="src">
                            <input  class="form-control" placeholder="To: address or city" name="des">
                            <span class="date"><input type="text" class="form-control" placeholder="Journey Date" id="datepicker"></span>
                            <span class="date"><input type="text" class="form-control" placeholder="Return Date" id="datepicker2"></span>
                            <button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search"></span> Review</button>
                            <button type="button" class="btn btn-info"><span class="glyphicon glyphicon-search"></span> Ticket</button>
                        </form>
                    </div>
                    <div class="col-sm-1"></div>
                </div>
            </div>
            <div class="clearfix"></div>
            <!-- Portfolio -->

<!--******************************************************************************************************************************-->            
<div>
<div id="left_column_bp">
      
      <h4 style="text-transform: uppercase">
        
          Popular Shohag Paribahan routes and Prices:
        
      </h4>
        
            





<div id="USD-trips" class="trips">
<table class="pricing">
  	<tbody>
    
          <tr>
          <td class="route"> 
			
				<h>Dhaka to Chittagong </h>
			         
          </td>

          <td class="price">
          
            
              
              
               <div class="demure">as low as</div>
              <span class="vivid">
                89 
              </span>
              
          </td>

          <td class="cta">
            <div class="button  no-price ">See More</div>
            
          </td>
          
        
        </tr>
    
          <tr>
          <td class="route"> 
			
				Dhaka to Sylhet 
			         
          </td>

          <td class="price">
          
            
              
              
              <div class="demure">as low as</div>
              <span class="vivid">
                49 
              </span>
          </td>

          <td class="cta">
            <div class="button  no-price ">See More</div>
            
          </td>
          
        
        </tr>
    
          <tr>
          <td class="route"> 
			
				Chittagong to Bogra 
			         
          </td>

          <td class="price">
          
            
              
              
              <div class="demure">as low as</div>
              <span class="vivid">
                33 
              </span>
              
          </td>

          <td class="cta">
            <div class="button  no-price ">See More</div>
            
          </td>
          
        
        </tr>
    
          <tr>
          <td class="route"> 
			
				Khulna to Cox's Bazar
			         
          </td>

          <td class="price">
          
            
              
              
              <div class="demure">as low as</div>
              <span class="vivid">
                39 
              </span>
              
          </td>

          <td class="cta">
            <div class="button  no-price ">See More</div>
            
          </td>
          
        
        </tr>
    
          <tr>
          <td class="route"> 
			
				Gaibandha to Dhaka 
			         
          </td>

          <td class="price">
          
            
              
              
              <div class="demure">as low as</div>
              <span class="vivid">
                108 
              </span>
              
          </td>

          <td class="cta">
            
            <div class="button  no-price ">See More</div>
            
          </td>
          
        
        </tr>
    
          
  	</tbody>
</table>
</div><!-- end trips -->
  
 </div>

 <div id="right_column_bp">
 	<img src="images/shohag.jpg" alt="Shohag Paribahan" class="img1">
 	
 </div>        	
            
<!--******************************************************************************************************************************--> 
            <div class="clearfix"></div>

            <!-- Navigation -->
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
                             </br>
                              <label><b>Ending Location</b></label>
                             <input type="text" placeholder="Enter Ending Location" name="uname" class="form-control" required="">
                             </br>
                              <label><b>Bus Name</b></label>
                             <input type="text" placeholder="Enter Bus Name" name="uname" class="form-control" required="">
                             </br>
                              <label><b>Fare</b></label>
                             <input type="text" placeholder="Enter Fare" name="uname" class="form-control" required="">
                             </br>
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
