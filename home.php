<?php
    session_start();
    include_once 'dbconnect.php';
    $postError=0;
    if(isset($_POST['review_btn']))
    {
        if(!isset($_POST['reviewStart']) || !isset($_POST['reviewEnd']) || !isset($_POST['reviewFare']) || !isset($_POST['reviewBusName']) || !isset($_POST['rate']))
        {
            $postError=1;
            
        }
        else 
        {
            if(isset($_SESSION['id'])){
            $start=$_POST['reviewStart'];
            $end=$_POST['reviewEnd'];
            $fare=$_POST['reviewFare'];
            $busName=$_POST['reviewBusName'];
            $rate=$_POST['rate'];
            $desc="";
            $date=date("Y-m-d");
            if(isset($_POST['message']))
            {
                $desc=$_POST['message'];
            }

            $bus_id_query="SELECT bus.bus_id FROM bus,travels_through,route WHERE bus.bus_id=travels_through.bus_id AND route.route_id=travels_through.route_id AND bus.bus_name='$busName' AND route.source='$start' AND route.destination='$end' ";
            $result=$conn->query($bus_id_query);
            //echo $bus_id_query;
            if($result->num_rows==1)
            {
                $row=$result->fetch_assoc();

                $busID=$row['bus_id'];
                $userID=$_SESSION['id'];

                $reviewInsertQuery="INSERT INTO `review` (`review_id`, `description`, `fare`, `up`, `down`, `post_date`, `rate`) VALUES (NULL, '$desc', $fare,'' ,'' , '$date', $rate)";
                //echo $reviewInsertQuery;
            
                if($conn->query($reviewInsertQuery)!=true) $postError=1;
                else
                { 
                    $reviewID=$conn->insert_id;
                    $postQuery="INSERT INTO `posts`(`posts_id`, `userID`, `reviewID`) VALUES (NULL,'$userID','$reviewID') ";
                    if($conn->query($postQuery)!=true) $postError=1;
                    else
                    {
                        $aboutQuery="INSERT INTO `about`(`about_id`, `busID`, `reviewID`) VALUES (NULL,'$busID','$reviewID')";
                        if($conn->query($aboutQuery)!=true) $postError=1;
                    }

                
                }
                header('Location: review.php');

            }
            else
            {
                $postError=1;

            }
            
        }
        }
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
                                <li><a href="buslist.php">Bus Info</a></li>
                                <li><a href="about.html">About Us</a></li>
                                <li><a href="#" data-toggle="modal" data-target="#contribute">Share Your Travel Experience</a></li>
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
        <div class="clearfix"></div>
        <!-- Navigation -->
        
            <div class="container-fluid fullwidth_back text-center">
                <div class="col-sm-12 review_btn_wrapper">
                    <div class="col-sm-10"></div>
                
                    <div class="col-sm-2">
                        <a href='review.php'><button type="button" class="btn btn-info review_btn" id="test4">Reviews</button></a>
                    </div>
                
                </div>
                <h1 class="text-uppercase search_h1">Welcome To Bus Traveling Community</h1>
                <p>Donec tincidunt augue in enim bibendum, at fringilla urna tincidunt.<br>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <div class="col-xs-12 col-sm-12 search">
                    <div class="col-sm-1"></div>
                    <div class="content_filter col-sm-10">
                        <form class="form-inline" method="get" action="ticket.php" autocomplete="off" >
                            <div class="btn-group srch">
                                <input type="text" class="form-control srch"  placeholder="From: address or city" required id="searchFrom" name='source'>
                                <ul class="results" id="fromList">
                                    
                                </ul>
                            </div>
                            <div class="btn-group srch">
                            <input type="text" class="form-control srch" placeholder="To: address or city" required id="searchTo" name='destination'>
                             <ul class="results" id="toList">
                                    
                            </ul>
                             </div>
                            <span class="date"><input type="text" class="form-control" placeholder="Journey Date" id="datepicker" name='date' required=""></span>
                            <span class="date"><input type="text" class="form-control" placeholder="Return Date" id="datepicker2"></span>
                            <button type="submit" class="btn btn-info" id="test3"><span class="glyphicon glyphicon-search" ></span> Search</button>
                        </form>
                    </div>
                    <div class="col-sm-1"></div>
                </div>

            </div>
            <div class="clearfix"></div>
            <!-- Portfolio -->
            <div class="container-fluid" id="about">

                <div class="container">
                    <h1 class="text-center heading">Frequently Asked Questions</h1><br/><br/>

                    <div class="col-sm-12 col-xs-12">
                        <div class="col-sm-5">
                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingOne">
                                        <h4 class="panel-title">
                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                <span class="glyphicon glyphicon-collapse-down"></span>  Lorem ipsum dolor sit amet, consectetur adipiscing elit Donec tincidunt?
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                        <div class="panel-body">
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably havent heard of them accusamus labore sustainable VHS.
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingTwo">
                                        <h4 class="panel-title">
                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                <span class="glyphicon glyphicon-collapse-down"></span>  Lorem ipsum dolor sit amet, consectetur adipiscing elit Donec tincidunt?
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                        <div class="panel-body">
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably havent heard of them accusamus labore sustainable VHS.
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingThree">
                                        <h4 class="panel-title">
                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                <span class="glyphicon glyphicon-collapse-down"></span>  Lorem ipsum dolor sit amet, consectetur adipiscing elit Donec tincidunt?
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                        <div class="panel-body">
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably havent heard of them accusamus labore sustainable VHS.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2"></div>
                        <div class="col-sm-5">
                            <div class="panel-group" id="accordion2" role="tablist" aria-multiselectable="true">

                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingFour">
                                        <h4 class="panel-title">
                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion2" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                                <span class="glyphicon glyphicon-collapse-down"></span>  Lorem ipsum dolor sit amet, consectetur adipiscing elit Donec tincidunt?
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                                        <div class="panel-body">
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably havent heard of them accusamus labore sustainable VHS.
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingFive">
                                        <h4 class="panel-title">
                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion2" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                                <span class="glyphicon glyphicon-collapse-down"></span>  Lorem ipsum dolor sit amet, consectetur adipiscing elit Donec tincidunt?
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
                                        <div class="panel-body">
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably havent heard of them accusamus labore sustainable VHS.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

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
                                <h1 class="text-center">Share your travel experience</h1>
                            </div>
                            <?php if(isset($_SESSION['id'])){ ?>

                            <form method="post" action="#" autocomplete="off">
                            
                            <div class="modal-body">
                                
                                <div class="form-group">
                                    <label><b>Starting Location: </b></label>
                                    <div class="btn-group srch">
                                        <input type="text"  class="form-control"  placeholder="Enter Location" required id="searchFromR" name="reviewStart">
                                            <ul class="results" id="fromListR">
                                    
                                            </ul>
                                    </div>
                                    <br><br>
                                    <label><b>Ending Location:</b></label>
                                    <div class="btn-group srch">
                                        <input type="text" class="form-control srch"  placeholder="Enter Location" required id="searchToR" name=reviewEnd>
                                            <ul class="results" id="toListR">
                                    
                                            </ul>
                                    </div>
                                    <br><br>
                                    <label><b>Bus Name:</b></label>
                                    <span class="bal">
                                    <div class="btn-group srch">
                                        <input type="text" class="form-control srch"  placeholder="Enter Bus Name" required id="searchBus" name="reviewBusName">
                                            <ul class="results" id="busList">
                                    
                                            </ul>
                                    </div></span>
                                    <br><br>
                                    <label><b>Fare:</b></label>
                                    <span class="sal">
                                    <div class="btn-group srch">
                                        <input type="number" placeholder="Enter Fare" class="form-control" required="" name="reviewFare">
                                    </div></span>
                                    <br><br>
                                    <div class="col-sm-12 col-xs-12">
                                        <div class="col-sm-2 col-xs-2">
                                            <label class="for_rating"><b>Rating</b></label>
                                        </div>
                                        <div class="col-sm-8 col-xs-8">
                                        <div class="rr">
                                            <div class="rate">

                                                <input type="radio" id="star5" name="rate" value="5" required="" />

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
                                        </div>
                                        <div class="col-sm-2 col-xs-2">
                                        </div>
                                    </div>
                                    <br><br>
                                    <label> Review </label>
                                    <textarea rows="5" class="form-control" name="message" placeholder="Review"></textarea>
                                    
                                    
                                </div>

                                <br><br>
                                <button class="btn-me" type="submit" name="review_btn">Submit</button>
                             
                            </div>

                            <div class="form-group" style="background-color:#f1f1f1">
                                <button  type="button" data-dismiss="modal" class="cancelbtn">Cancel</button>
                            </div>
                                
                            </form>
                            <?php } 
                            else
                                echo "<a href='login.php'><button type='button' class='btn-me' id='test4'>Login Here First</button></a>";
                                ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        


        <script src="js/jquery-1.11.3.min.js"></script>
        <script src="js/bootstrap.min.js"></script>

        <script>
            $(function () {

                $("#searchFrom").hide();
                $("#searchTo").hide();
                $("#test3").hide();
                $("#test4").hide();
                $("#datepicker").hide();
                $("#datepicker2").hide();
                $("#searchFrom").fadeIn(1000);
                $("#searchTo").fadeIn(1000);
                //$("#test3").show();
                $("#datepicker").fadeIn(1000);
                $("#datepicker2").fadeIn(1000,function(){
                    $("#test3").show(500);
                    $("#test4").show(500);
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

                $("#searchFromR").keyup(function(){
                     $.get("searchLocation.php?source="+$("#searchFromR").val(), function(data, status){
                            $("#fromListR").empty();
                            $("#fromListR").append(data);
                            $("#fromListR li").mouseenter(function(){
                    
                                $("#searchFromR").val($(this).text());
                            });
                    });
                });
                $("#searchToR").keyup(function(){
                     $.get("searchLocation.php?dest="+$("#searchToR").val(), function(data, status){
                           // window.alert("bal");
                            $("#toListR").empty();
                            $("#toListR").append(data);
                            $("#toListR li").mouseenter(function(){
                    
                                $("#searchToR").val($(this).text());
                            });
                    });
                });
                $("#searchBus").keyup(function(){
                    var s=$("#searchFromR").val();
                    var d=$('#searchToR').val();
                    var b=$("#searchBus").val();
                     $.get("searchBus.php?name="+b+"&source="+s+"&destination="+d, function(data, status){
                           // window.alert("bal");
                            $("#busList").empty();
                            $("#busList").append(data);
                            $("#busList li").mouseenter(function(){
                    
                                $("#searchBus").val($(this).text());
                            });
                    });
                });
                
                
            });

        </script>

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
                $("#datepicker").datepicker({ dateFormat: 'yy-mm-dd', minDate: 0 });
                
            });

            $(function () {
                $("#datepicker2").datepicker({ dateFormat: 'yy-mm-dd', minDate: 0 });
                
            });
        </script>
        <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    </body>
</html>
