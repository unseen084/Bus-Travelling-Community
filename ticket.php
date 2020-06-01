<?php

    session_start();
    include_once 'dbconnect.php';
    if(isset($_GET['source']) && isset($_GET['destination']) && isset($_GET['date']))
    {
        $source=$_GET['source'];
        $destination=$_GET['destination'];
        $date=$_GET['date'];



        $q="SELECT * FROM `bus` NATURAL JOIN travels_through NATURAL JOIN route WHERE route_id=(SELECT route_id FROM `route` WHERE route.source='$source' AND route.destination='$destination')";

        if(isset($_GET['busname']))
        {
            $namee=$_GET['busname'];
            $q=$q. "AND bus_name='$namee'";
        }
        //echo $q;
        $result=$conn->query($q);

    }
    

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

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
        <link rel="stylesheet" href="css/seat.css">





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
                                <li><a href="team.html">Team</a></li>
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
                                <li><a href="#">Ticket</a></li>
                                <li><a href="buslist.php">Bus Info</a></li>
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
        <div  style="background-image:url(images/3.jpg)">

            <div class="container">

                <div class="col-xs-12 col-sm-12 search">

                    <div class="col-sm-6">
                        <form class="form-inline" method="get" action="ticket.php" autocomplete="off">

                        <?php 
                            if(isset($_GET['source']) && isset($_GET['destination']) && isset($_GET['date']))
                            {
                                echo "<div class='btn-group srch'>
                                <input type='text' class='form-control srch' placeholder='From: address or city' required='' id='searchFrom' name='source' value=$source>
                                <ul class='results' id='fromList' >
                                    
                                </ul>
                            </div>
                            <div class='btn-group srch'>
                                <input type='text' class='form-control srch' placeholder='To: address or city' required='' id='searchTo' name='destination' value=$destination>
                                <ul class='results' id='toList' >
                                    
                                </ul>
                            </div>
                            <span class='date'><input type='text' size='10' class='form-control' placeholder='Journey Date' id='datepicker' required='' name='date' value=$date></span>";
                            }
                            else
                            {
                                echo "<div class='btn-group srch'>
                                <input type='text' class='form-control srch'  placeholder='From: address or city' required='' id='searchFrom' name='source'>
                                <ul class='results' id='fromList'>
                                    
                                </ul>
                            </div>
                            <div class='btn-group srch'>
                                <input type='text' class='form-control srch' placeholder='To: address or city' required='' id='searchTo' name='destination'>
                                <ul class='results' id='toList'>
                                    
                                </ul>
                            </div>
                            <span class='date'><input type='text' size='10' class='form-control' placeholder='Journey Date' id='datepicker' required='' name='date'></span>";
                            }
                        ?>
                            

                            <button type="submit" class="btn btn-info"> Modify</button>
                        </form>
                    </div>
                    <div class="col-sm-6">
                        <span class="tt">   <div class="btn-group">
                                <input type="submit" class="form-control btn btn-danger" value="Print/sms Ticket">
                            </div>
                            <div class="btn-group">
                                <input type="submit" class="form-control btn btn-danger" value="Cancel Booking">
                            </div>

                    </div></span>
                </div>



                <div  class="col-sm-12 col-xs-12"><p class="filter_text"> Filters: </p><hr></div>
                <div class="content_filter col-sm-12 col-xs-12">
                    <div class="col-sm-7 col-xs-12">
                    
                    <form method='get' action='ticket.php' autocomplete="off">
                        

                            <?php

                            if(isset($_GET['busname']))
                            {
                                echo "<div class='btn-group srch'>
                                <input type='text' class='form-control srch'  placeholder='Bus Name' id='busName' name='busname'  value='$namee'>
                                <ul class='results' id='busList'>

                                    
                                </ul>
                            </div>";
                            }
                            else
                            {
                                echo "<div class='btn-group srch'>
                                <input type='text' class='form-control srch'  placeholder='Bus Name' id='busName' name='busname'>
                                <ul class='results' id='busList'>

                                    
                                </ul>
                            </div>";
                            }


                            if(isset($_GET['source']) && isset($_GET['destination']) && isset($_GET['date']))
                            {
                                echo "<div class='btn-group srch'>
                                <input type='hidden' class='form-control srch' placeholder='From: address or city' required='' id='searchFrom' name='source' value=$source>
                                <ul class='results' id='fromList' >
                                    
                                </ul>
                            </div>
                            <div class='btn-group srch'>
                                <input type='hidden' class='form-control srch' placeholder='To: address or city' required='' id='searchTo' name='destination' value=$destination>
                                <ul class='results' id='toList' >
                                    
                                </ul>
                            </div>
                            <span class='date'><input type='hidden' size='10' class='form-control' placeholder='Journey Date' id='datepicker' required='' name='date' value=$date></span>";
                            } ?>


                        
                        
                        
                        <button type="submit" class="btn btn-info" >Filter</button>
                    </form>
                    </div>
                    <div class="col-sm-1 col-xs-12"><br></div>
                    <div class="col-sm-4 col-xs-12">
                        <div class="btn-group">
                            <p class="sort_text">Sort: </p>
                        </div>
                        <div class="btn-group">
                            <div class="btn-group">
                                <input type="submit" class="form-control btn btn-danger" value="Fare">
                            </div>
                            <div class="btn-group">
                                <input type="submit" class="form-control btn btn-danger" value="Departure">
                            </div>
                            <div class="btn-group">
                                <input type="submit" class="form-control btn btn-danger" value="Rating">
                            </div>
                        </div>
                    </div>
                </div>
                <div  class="col-sm-12 col-xs-12"><hr></div>

                <?php
                    if(isset($result) && $result->num_rows>0)
                    {

                        while($row=$result->fetch_assoc())
                        {
                            $busID=$row['bus_id'];
                            $busName=$row['bus_name'];
                            $deptTime=$row['departure_time'];
                            $arrTime=$row['arrival_time'];
                            $fare=$row['seat_price'];
                            $type=$row['type'];

                            //echo $date;
                            $q= "SELECT COUNT(*) FROM (SELECT ticket.ticket_id FROM isbooked_for,ticket WHERE isbooked_for.busID=$busID AND isbooked_for.ticketID=ticket.ticket_id AND ticket.travel_date='$date') AS tmp NATURAL JOIN seats_of_ticket";
                            $r=$conn->query($q);
                            //echo $q;

                            $bookedSeats=$r->fetch_assoc();

                            $totalSeats=$row['total_seat'];
                            
                            $avSeats=(int)$totalSeats-(int)$bookedSeats['COUNT(*)'];
                            //echo $q;
                            //echo $busID .$bookedSeat['COUNT(*)'];

                            $q="SELECT AVG(review.rate) FROM about,review WHERE about.busID=$busID AND about.reviewID=review.review_id";
                            $r=$conn->query($q);
                            $row=$r->fetch_assoc();
                            $rate=(double)$row['AVG(review.rate)'];
                            echo "<div class='content col-sm-12 col-xs-12'>
                                <br/>
                                <div class='col-sm-12 col-xs-12'>
                                    <div class='col-sm-3 col-xs-6'>
                                        <h4>Bus Name</h4>
                                    </div>
                                    <div class='col-sm-2 col-xs-6'>
                                        <h4>Time</h4>
                                    </div>
                                    <div class='col-sm-2 col-xs-6'>
                                        <h4>Rating</h4>
                                    </div>
                                    <div class='col-sm-2 col-xs-6'>
                                        <h4>Available Seats</h4>
                                    </div>
                                    <div class='col-sm-3 col-xs-6'>
                                        <h4>Fare</h4>
                                    </div>
                                </div>

                                <div class='col-sm-12 col-xs-12'>
                                    <div class='col-sm-3 col-xs-6'>
                                        <p>$busName</p>
                                        <p>type: $type</p>
                                    </div>
                                    <div class='col-sm-2 col-xs-6'>
                                        <p>$deptTime -> $arrTime</p>
                                    </div>
                                    <div class='col-sm-2 col-xs-6'>
                                        <p>$rate/5</p>
                                        <div class='f_left'>
                                            <span class='fa fa-star'></span>
                                            <span class='fa fa-star'></span>
                                            <span class='fa fa-star'></span>
                                            <span class='fa fa-star'></span>
                                            <span class='fa fa-star'></span>
                                        </div>
                                    </div>
                                    <div class='col-sm-2 col-xs-6'>
                                        <p>$avSeats Seats</p>
                                        
                                    </div>

                                    <div class='col-sm-3 col-xs-6'>
                                        <p>$fare bdt</p>
                                        <a href='reserve/reserve.php?id=$busID&date=$date&source=$source&des=$destination'><button> view seats </button></a>
                                    </div>
                                </div>

                            </div>";
                        }
                    }
                    else
                    {

                    }
                ?>


            </div>
        </div>

        
         




    <!-- for seat-->


    <!-- set end-->                     













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
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
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

        $("#searchFrom").keyup(function(){
                     $.get("searchLocation.php?source="+$("#searchFrom").val(), function(data, status){
                            $("#fromList").empty();
                            $("#fromList").append(data);
                            $("#fromList li").mouseenter(function(){
                    
                                $("#searchFrom").val($(this).text());
                            });
                    });
                });
                $("#searchTo").keyup(function(){
                     $.get("searchLocation.php?dest="+$("#searchTo").val(), function(data, status){
                           // window.alert("bal");
                            $("#toList").empty();
                            $("#toList").append(data);
                            $("#toList li").mouseenter(function(){
                    
                                $("#searchTo").val($(this).text());
                            });
                    });
                });
                $("#busName").keyup(function(){
                    var s=$("#searchFrom").val();
                    var d=$('#searchTo').val();
                    var b=$("#busName").val();
                    //window.alert(s+d+b);
                     $.get("searchBus.php?name="+b+"&source="+s+"&destination="+d, function(data, status){
                           // window.alert("bal");
                            $("#busList").empty();
                            $("#busList").append(data);
                            $("#busList li").mouseenter(function(){
                    
                                $("#busName").val($(this).text());
                            });
                    });
                });

        
        $(function () {
                $("#datepicker").datepicker({ dateFormat: 'yy-mm-dd', minDate: 0 });
                
            });
    </script>
    <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
</body>
</html>
