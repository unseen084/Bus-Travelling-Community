<!doctype html>
<?php
session_start();
include_once 'dbconnect.php';

$onlyByFare=0;
$onlyByRating=0;
$b_name=0;
$src = 0;
$des = 0;
$price_range = 0;
$sr=0;

if(isset($_POST['fare'])) $onlyByFare=1;
if(isset($_POST['rating'])) $onlyByRating=1;
if(isset($_POST['search'])) $sr = 1;
if(isset($_POST['bus_name']) && !empty($_POST['bus_name'])) $b_name=1;
if(isset($_POST['src']) && !empty($_POST['src'])) $src = 1;

if(isset($_POST['des']) && !empty($_POST['des'])) $des = 1;
if(isset($_POST['price_range']) && !empty($_POST['price_range'])) $price_range = 1;

//comment
if(isset($_POST['comment']) && !empty($_POST['comment']) && isset($_SESSION['id']) && isset($_GET['revid'])){

    $sql = "INSERT INTO comments_on (comments_on_id,userID,reviewID,msg) VALUES (NULL,'".$_SESSION['id']."','".$_GET['revid']."','".$_POST['comment']."')";
    $res = $conn->query($sql);
    
}
//vote
if(isset($_SESSION['id']) && (isset($_POST['upv']) || isset($_POST['downv']) ) && isset($_GET['revid'])){
    //del prev votes
    $usid = $_SESSION['id'];
    $rvid = $_GET['revid'];
    $sql = "SELECT * FROM posts WHERE reviewID=$rvid";
    $res = $conn->query($sql);
    $ret = $res->fetch_assoc();
    if($ret['userID']!=$usid){
    //del prev post likes/dislikes
    $whoposted = $ret['userID'];
    $sql = "SELECT * FROM votes WHERE userID=$usid AND reviewID=$rvid";
    $res = $conn->query($sql);
    if($res->num_rows>0){
        $ret = $res->fetch_assoc();
        if($ret['liked']==1){
            $sql = "SELECT * FROM review WHERE review_id='$rvid'";
            $res = $conn->query($sql);
            $ret = $res->fetch_assoc();
            $w = $ret['up'] - 1;
            $sql = "UPDATE review SET up = $w WHERE review_id=$rvid";
            $conn->query($sql);
        }else{
            $sql = "SELECT * FROM review WHERE review_id='$rvid'";
            $res = $conn->query($sql);
            $ret = $res->fetch_assoc();
            $w = $ret['down'] - 1;
            $sql = "UPDATE review SET down = $w WHERE review_id=$rvid";
            $conn->query($sql);
        }
    }



    $sql = "DELETE FROM votes WHERE userID='$usid' AND reviewID='$rvid'";
    $conn->query($sql);
    if(isset($_POST['upv'])){
        $sql = "INSERT INTO votes(votes_id,userID,reviewID,liked,disliked) VALUES (NULL,'".$_SESSION['id']."','".$_GET['revid']."','1','0')";
        $res = $conn->query($sql);

        $sql = "SELECT * FROM review WHERE review_id='$rvid'";
        $res = $conn->query($sql);
        $ret = $res->fetch_assoc();
        $w = $ret['up'] + 1;
        $sql = "UPDATE review SET up = $w WHERE review_id=$rvid";
        $conn->query($sql);

        $sql = "SELECT * FROM user WHERE user_id=$whoposted";
        $res = $conn->query($sql);
        $ret = $res->fetch_assoc();
        $w = $ret['uup'] + 1;
        $sql = "UPDATE user SET uup = $w WHERE user_id=$whoposted";
        $conn->query($sql);
    }
    if(isset($_POST['downv'])){
        $sql = "INSERT INTO votes(votes_id,userID,reviewID,liked,disliked) VALUES (NULL,'".$_SESSION['id']."','".$_GET['revid']."','0','1')";
        $res = $conn->query($sql);

        $sql = "SELECT * FROM review WHERE review_id='$rvid'";
        $res = $conn->query($sql);
        $ret = $res->fetch_assoc();
        $w = $ret['down'] + 1;
        $l = $ret['up'];
        $sql = "UPDATE review SET down = $w WHERE review_id=$rvid";
        $conn->query($sql);

        $sql = "SELECT * FROM user WHERE user_id=$whoposted";
        $res = $conn->query($sql);
        $ret = $res->fetch_assoc();
        $w = $ret['udown'] + 1;
        $sql = "UPDATE user SET udown = $w WHERE user_id=$whoposted";
        $conn->query($sql);
        //auto removal diff between up and down 100
        $d = $w - $l;
        if($d>=100){
            $sql = "DELETE FROM comments_on WHERE reviewID=$rvid";
            $conn->query($sql);
            $sql = "DELETE FROM votes WHERE reviewID=$rvid";
            $conn->query($sql);
            $sql = "DELETE FROM posts WHERE reviewID=$rvid";
            $conn->query($sql);
            $sql = "DELETE FROM about WHERE reviewID=$rvid";
            $conn->query($sql);
            $sql = "DELETE FROM review WHERE review_id=$rvid";
            $conn->query($sql);
        }
    }
    }
    
    
}
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Reviews!</title>
        <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
        <link type="text/css" rel="stylesheet" href="css/bootstrap.css">
        <link type="text/css" rel="stylesheet" href="css/bootstrap-theme.min.css">
        <link type="text/css" rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <style>
            html, body {
                width: 100%;
                height: 100%;
                margin: 0;

            }
            .text_bold {
                font-weight: bold;
            }
            .cont {
                padding: 100px 0;

                background-size: 100%;
                background-position: 50% 50%;
            }

            .content {
                margin-bottom: 10px;
                color: #000;
                border: 2px solid #fff;
                background: rgba(255,255,255,0.7);
            }

            <!--   ___For Filter Section___ -->
            .content_filter {

            }
            .filter_text {
                font-weight: bold;
                font-size: 15px;
                color: red;
                margin-top: 20px;
            }
            .sort_text {
                font-weight: bold;
                font-size: 15px;
                color: oldlace;
            }
            .srch {
                position: relative;
                margin: 0 auto;
            }
            .srch input:focus + .results { display: block }
            .srch a:hover { text-decoration: underline }

            .srch .results {
                display: none;
                position: absolute;
                top: 35px;
                left: 0;
                right: 0;
                z-index: 10;
                padding: 0;
                margin: 0;
                border-width: 1px;
                border-style: solid;
                border-color: #cbcfe2 #c8cee7 #c4c7d7;
                border-radius: 3px;
                background-color: #fdfdfd;
                background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #fdfdfd), color-stop(100%, #eceef4));
                background-image: -webkit-linear-gradient(top, #fdfdfd, #eceef4);
                background-image: -moz-linear-gradient(top, #fdfdfd, #eceef4);
                background-image: -ms-linear-gradient(top, #fdfdfd, #eceef4);
                background-image: -o-linear-gradient(top, #fdfdfd, #eceef4);
                background-image: linear-gradient(top, #fdfdfd, #eceef4);
                -webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
                -moz-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
                -ms-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
                -o-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
                box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
            }

            .srch .results li { display: block }

            .srch .results li:first-child { margin-top: -1px }

            .srch .results li:first-child:before, .srch .results li:first-child:after {
                display: block;
                content: '';
                width: 0;
                height: 0;
                position: absolute;
                left: 50%;
                margin-left: -5px;
                border: 5px outset transparent;
            }

            .srch .results li:first-child:before {
                border-bottom: 5px solid #c4c7d7;
                top: -11px;
            }

            .srch .results li:first-child:after {
                border-bottom: 5px solid #fdfdfd;
                top: -10px;
            }

            .srch .results li:first-child:hover:before, .srch .results li:first-child:hover:after { display: none }

            .srch .results li:last-child { margin-bottom: -1px }

            .srch .results a {
                display: block;
                position: relative;
                margin: 0 -1px;
                padding: 6px 40px 6px 10px;
                color: #808394;
                font-weight: 500;
                text-shadow: 0 1px #fff;
                border: 1px solid transparent;
                border-radius: 3px;
            }

            .srch .results a span { font-weight: 200 }

            .srch .results a:before {
                content: '';
                width: 18px;
                height: 18px;
                position: absolute;
                top: 50%;
                right: 10px;
                margin-top: -9px;
                background: url("http://cssdeck.com/uploads/media/items/7/7BNkBjd.png") 0 0 no-repeat;
            }

            .srch .results a:hover {
                text-decoration: none;
                color: #fff;
                text-shadow: 0 -1px rgba(0, 0, 0, 0.3);
                border-color: #2380dd #2179d5 #1a60aa;
                background-color: #338cdf;
                background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #59aaf4), color-stop(100%, #338cdf));
                background-image: -webkit-linear-gradient(top, #59aaf4, #338cdf);
                background-image: -moz-linear-gradient(top, #59aaf4, #338cdf);
                background-image: -ms-linear-gradient(top, #59aaf4, #338cdf);
                background-image: -o-linear-gradient(top, #59aaf4, #338cdf);
                background-image: linear-gradient(top, #59aaf4, #338cdf);
                -webkit-box-shadow: inset 0 1px rgba(255, 255, 255, 0.2), 0 1px rgba(0, 0, 0, 0.08);
                -moz-box-shadow: inset 0 1px rgba(255, 255, 255, 0.2), 0 1px rgba(0, 0, 0, 0.08);
                -ms-box-shadow: inset 0 1px rgba(255, 255, 255, 0.2), 0 1px rgba(0, 0, 0, 0.08);
                -o-box-shadow: inset 0 1px rgba(255, 255, 255, 0.2), 0 1px rgba(0, 0, 0, 0.08);
                box-shadow: inset 0 1px rgba(255, 255, 255, 0.2), 0 1px rgba(0, 0, 0, 0.08);
            }

            <!--   ___Filter Section Ends___ -->

            .review_text {
                font-size: 15px;
            }
            .like {
                margin-right: 10px;
            }

            .cmnt {
                border: none;
                background: none;
            }
            .reply_btn {
                border: none;
                background: none;
                color: blue;
            }
            .reply_body {
                font-size: 13px;
            }
        </style>
    </head>

    <body>

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
        <!-- Navigation Ends -->
        <!--Review Start-->
        <div class="cont paralaxbg" style="background-image:url(images/slider1.jpg)">
            <div class="container">
                <div class="col-sm-12 col-xs-12">
                    <div class="content text-center col-sm-12 col-xs-12">
                        <br/>
                        <h4>Latest Reviews </h4>

                    </div>
                    <!--Filter Suggestions Start-->
                    <div  class="col-sm-12 col-xs-12"><h class="filter_text"><b> Filters: </b></h><hr></div>
                    <div class="content_filter col-sm-12 col-xs-12">
                        <div class="col-sm-7 col-xs-12">
                        <form method="post" action="review.php">
                            <div class="btn-group srch">
                                <input type="text" class="form-control srch" size="10" placeholder="Bus Name" name="bus_name"/>
                                <!--<ul class="results" >
                                    <li><a href="#">Search Result #1<br /><span>Description...</span></a></li>
                                    <li><a href="#">Search Result #2<br /><span>Description...</span></a></li>
                                    <li><a href="#">Search Result #3<br /><span>Description...</span></a></li>
                                    <li><a href="#">Search Result #4</a></li>
                                </ul>-->
                            </div>
                            <div class="btn-group srch">
                                <input type="text" class="form-control srch" size="10" placeholder="Source" name="src"/>
                                
                                <!--<ul class="results" >
                                    <li><a href="#">Search Result #1<br /><span>Description...</span></a></li>
                                    <li><a href="#">Search Result #2<br /><span>Description...</span></a></li>
                                    <li><a href="#l">Search Result #3<br /><span>Description...</span></a></li>
                                    <li><a href="#">Search Result #4</a></li>
                                </ul>-->
                            </div>
                            <div class="btn-group srch">
                                <input type="text" class="form-control srch" size="10" placeholder="Destination" name="des"/>
                                <!--<ul class="results" >
                                    <li><a href="#">Search Result #1<br /><span>Description...</span></a></li>
                                    <li><a href="#">Search Result #2<br /><span>Description...</span></a></li>
                                    <li><a href="#">Search Result #3<br /><span>Description...</span></a></li>
                                    <li><a href="#">Search Result #4</a></li>
                                </ul>-->
                            </div>
                            <div class="btn-group srch">
                                <input type="text" class="form-control srch" size="10" placeholder="Price Range" name="price_range"/>
                                
                                <!--<ul class="results" >
                                    <li><a href="#">Search Result #1<br /><span>Description...</span></a></li>
                                    <li><a href="#">Search Result #2<br /><span>Description...</span></a></li>
                                    <li><a href="#">Search Result #3<br /><span>Description...</span></a></li>
                                    <li><a href="#">Search Result #4</a></li>
                                </ul>-->
                            </div>
                        
                    </div>
                        <div class="col-sm-1 col-xs-12"><br></div>
                        <div class="col-sm-4 col-xs-12">
                            <div class="btn-group">
                                <p class="sort_text">Sort: </p>
                            </div>
                            <div class="btn-group">
                                
                                <div class="btn-group">
                                    <input type="submit" class="form-control btn btn-danger"  name='fare' value="Fare">
                                </div>
                                <div class="btn-group">
                                    <input type="submit" class="form-control btn btn-danger"  name='rating' value="Rating">
                                </div>
                                
                                
                            </div>
                                <div class="btn-group">
                                    <input type="submit" class="form-control btn btn-danger"  color="#28a4c9" name='search' value="Search">
                                </div>
                        </div>

                    
                    </div>
                    </form>
                    <div  class="col-sm-12 col-xs-12"><hr></div>
                    <!--Filter Suggestions End-->

                    <!--Post Starts-->
                    <?php
                    $general = "SELECT * FROM about INNER JOIN bus ON busID = bus_id INNER JOIN 
                        (select * from posts inner join review on reviewID=review_id inner join user on posts.userID = user_id) as gen ON gen.review_id=about.reviewID ";
                    $last = " ORDER BY post_date DESC LIMIT 20";
                    $defaultReview = $general." INNER JOIN travels_through ON travels_through.bus_id=busID INNER JOIN route ON travels_through.route_id=route.route_id";
                    
                    $byBusName;
                    if($b_name==1){

                        $BN = $_POST['bus_name'];
                        //echo $BN;
                        $byBusName =" WHERE bus_name='$BN' ";
                    }
                    $bysrc;
                    if($src==1){
                        $SR = $_POST['src'];
                        if($b_name==1){
                            $defaultReview = $defaultReview.$byBusName." AND "."source='$SR' ";
                        }else{
                            $defaultReview = $defaultReview." WHERE "."source='$SR' ";
                        }
                    }
                    $bydes;
                    if($des==1){
                        $DES = $_POST['des'];
                        //$bydes = " INNER JOIN travels_through ON travels_through.bus_id=busID INNER JOIN route ON travels_through.route_id=route.route_id";
                        if($src==0){
                            if($b_name==1){
                                $defaultReview = $defaultReview.$byBusName." AND "."destination='$DES' ";
                            }else{
                                $defaultReview = $defaultReview." WHERE "."destination='$DES' ";
                            }
                        }else{
                            $defaultReview = $defaultReview." AND destination='$DES' ";
                        }
                    }
                    $byprice;
                    if($price_range==1){
                        $PR = $_POST['price_range'];
                        //$bydes = " INNER JOIN travels_through ON travels_through.bus_id=busID INNER JOIN route ON travels_through.route_id=route.route_id";
                        if($src==0 && $des==0){
                            if($b_name==1){
                                $defaultReview = $defaultReview.$byBusName." AND "."fare<='$PR' ";
                            }else{
                                $defaultReview = $defaultReview." WHERE "."fare<='$PR' ";
                            }
                        }else{
                            $defaultReview = $defaultReview." AND fare<='$PR' ";
                        }
                    }
                   
                    $getReview = $defaultReview;
                    if($b_name && $des==0 && $src==0 && $price_range==0) $getReview = $defaultReview.$byBusName;
                    
                    if($onlyByRating){
                        $last = " ORDER BY rate DESC LIMIT 20";
                    }else if($onlyByFare){
                        $last = " ORDER BY fare ASC LIMIT 20";
                    }
                    $getReview = $getReview.$last;
                    
                    //echo $getReview;
                    
                    $result = $conn->query($getReview);
                    if($result->num_rows>0){
                        
                        while($row=$result->fetch_assoc()){
                            $uname = $row['userName'];
                            $uid = $row['user_id'];
                            $des = $row['description'];
                            $to = $row['source'];
                            $from = $row['destination'];
                            $fare = $row['fare'];
                            $bname = $row['bus_name'];
                            $upv = $row['up'];
                            $dwnv = $row['down'];
                            $revid = $row['review_id'];
                    ?>
                    <div class="content col-sm-12 col-xs-12">
                        <br/>
                        <div class="col-sm-12 col-xs-12">
                            <div class="col-sm-3 col-xs-6">
                                <h4>From</h4><p><?php echo $to ?></p>
                            </div>
                            <div class="col-sm-3 col-xs-6">
                                <h4>To</h4><p><?php echo $from ?></p>
                            </div>
                            <div class="col-sm-3 col-xs-6">
                                <h4>Price</h4><p><?php echo $fare ?></p>
                            </div>
                            <div class="col-sm-3 col-xs-6">
                                <h4>Bus</h4><p><?php echo $bname ?></p>
                            </div>
                        </div>
                        <div class="col-sm-12 col-xs-12">
                            <div class="col-sm-6 col-xs-6 text-justify">
                                <?php
                                $uV=$row['uup'];
                                $dV=$row['udown'];
                                if($uV+$dV!=0) $rate = ($uV*5)/($uV+$dV);
                                else $rate=0;
                                ?>
                                <span class="fa fa-user text_bold"><a href="profile.php?user=<?php echo $uname?>&uid=<?php echo $uid ?>"><?php echo " ",$uname ," <br><br>"?></a><font color="red"> Contribution: <?php echo (int)$rate ?></font></span>
                            </div>
                            <div class="col-sm-6 col-xs-6">
                                <div class="f_right">
                                    <?php
                                        $ret = $row['rate'];
                                        
                                        for($i=1;$i<=$ret;$i++){
                                            ?><span class="fa fa-star"></span><?php
                                        }
                                        for(;$i<=5;$i++){
                                            ?><i class="fa fa-star-o" aria-hidden="true"></i><?php
                                        }
                                    ?>
                                    
                                    
                                </div>
                            </div> 
                        </div>

                        <div class="col-sm-12 col-xs-12">
                            <blockquote>
                                <span class="review_text"><?php echo $des ?></span>
                            </blockquote>
                        </div>
                        <div class="col-sm-12 col-xs-12">
                            <form  method="post">
	                            <div class="col-sm-6 col-xs-6">
	                                <?php
	                                //dekhte hobe current user like or dislike dise naki
	                                if(isset($_SESSION['id'])) $usid = $_SESSION['id'];
	                                else $usid = "";
	                                $sql = "SELECT * FROM votes WHERE userID = '$usid' AND reviewID = '$revid'";
	                                $res = $conn->query($sql);
	                                if($res->num_rows>0){
	                                    $ret = $res->fetch_assoc();
	                                    if($ret['liked']==1){
	                                        ?>
	                                        <button formaction="review.php" style="color:#008CBA" name="upv"><span class="fa fa-thumbs-up like"> <?php echo $upv ?> </span></button>
	                                        <button formaction="review.php?revid=<?php echo $revid ?>" name="downv"><span class="fa fa-thumbs-down"> <?php echo $dwnv ?></span></button>
	                                        <?php
	                                    }else if($ret['disliked']==1){
	                                        ?>
	                                        <button formaction="review.php?revid=<?php echo $revid ?>" name="upv"><span class="fa fa-thumbs-up like"> <?php echo $upv ?> </span></button>
	                                        <button formaction="review.php" style="color:#008CBA" name="downv"><span class="fa fa-thumbs-down"> <?php echo $dwnv ?></span></button>
	                                        <?php
	                                    }else{
	                                        ?>
	                                        <button formaction="review.php?revid=<?php echo $revid ?>" name="upv"><span class="fa fa-thumbs-up like"> <?php echo $upv ?> </span></button>
	                                        <button formaction="review.php?revid=<?php echo $revid ?>" name="downv"><span class="fa fa-thumbs-down"> <?php echo $dwnv ?></span></button>
	                                        <?php
	                                    }
	                                    
	                                }else{
	                                    ?>
	                                    <button formaction="review.php?revid=<?php echo $revid ?>" name="upv"><span class="fa fa-thumbs-up like"> <?php echo $upv ?> </span></button>
	                                    <button formaction="review.php?revid=<?php echo $revid ?>" name="downv"><span class="fa fa-thumbs-down"> <?php echo $dwnv ?></span></button>
	                                    <?php
	                                }
	                                ?>
	                                
	                            </div>
                            </form>
                            <?php
                            	$total_comm=0;
                            	$commsql1 = "SELECT * FROM comments_on WHERE reviewID='$revid'";
                            	$runcommquery1 = $conn->query($commsql1);
                           		 //echo $commsql1;
                            	if($runcommquery1->num_rows>0){
                                
                                	while($ret = $runcommquery1->fetch_assoc()){
                                    	$total_comm++;
                               		 }
                            	}
                            ?>
                            <div class="col-sm-6 col-xs-6">
                                <button class="cmnt f_right tempFlip" id="flip">
                                	<span class="fa fa-comment f_right"> <?php echo $total_comm ?></span>
                            	</button>
                                
                            </div>
                            
                            
                        </div>
                        
                        <div class="col-sm-12 col-xs-12 tempPanel" id="panel" style="display: none;">
                            <hr>
                            <form action="review.php?revid=<?php echo $revid ?>" method="post">
                            <div class="input-group col-sm-6 col-xs-12">
                                <input type="text" class="form-control" placeholder="Write a comment..." name="comment">
                                <span class="input-group-btn">
                                    <button class="btn btn-info" type="submit">Comment</button>
                                </span>
                            </div>
                            </form>
                            <br/>
                            <!--Comment Starts-->
                            <?php
                            //revid uid
                            $commsql1 = "SELECT * FROM comments_on WHERE reviewID='$revid'";
                            $runcommquery1 = $conn->query($commsql1);
                            if($runcommquery1->num_rows>0){
                                while($getcommquery1 = $runcommquery1->fetch_assoc()){
                                $commuserid = $getcommquery1['userID'];
                                $commusersql = "SELECT * FROM user WHERE user_id='$commuserid'";
                                $getcommuser = $conn->query($commusersql);
                                $usercommented = $getcommuser->fetch_assoc();
                                $usercommented = $usercommented['userName'];
                                $msg = $getcommquery1['msg'];
                                ?>
                                <div class="col-sm-12 col-xs-12">
                                <br>
                                <span class="fa fa-user text_bold"> <a href="#"><?php echo $usercommented ?></a></span> <?php echo $msg ?>
                                <br/>
                                
                            </div>
                            <?php
                                }
                            }
                            ?>
                            <!--Comment Ends-->
                       </div>
                    </div>
                    <?php
                                
                        }
                    }
                    ?>
                    <!--Post Ends-->
                </div>
            </div>
        </div>
        <!--Review End-->

        <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script> 
        <script src="js/paralaxbg.js"></script> 
        <script>
            initParalaxBg();
        </script><script type="text/javascript">

            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-36251023-1']);
            _gaq.push(['_setDomainName', 'jqueryscript.net']);
            _gaq.push(['_trackPageview']);

            (function () {
                var ga = document.createElement('script');
                ga.type = 'text/javascript';
                ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0];
                s.parentNode.insertBefore(ga, s);
            })();

        </script>


        <!-- Footer -->
        <div class="container-fluid review_footer">
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
                                        <input type="text" class="form-control"  placeholder="Enter Location" required id="searchFromR" name="reviewStart">
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
                                    <br>
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


        <script src="js/paralaxbg.min.js"></script>
        <script src="js/jquery-1.11.3.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script>
            /* Starts slide toggle  */
            $(document).ready(function () {
                $(".tempPanel").hide();
                $(".tempFlip").click(function () {
                	
                    if($(this).parent().parent().next().is(':visible'))
                    {
                        $(".tempPanel").hide("slow");
                    }
                    else
                    {
                        $(".tempPanel").hide("slow");
                        $(this).parent().parent().next().slideToggle("slow");
                    }
                	
                	
                    //$(".tempPanel").slideToggle("slow");
                });
            });
            $(document).ready(function () {
                $("#replyPanel1").hide();
                $("#replyFlip1").click(function () {
                    $("#replyPanel1").slideToggle("slow");
                });
            });
            $(document).ready(function () {
                $("#replyPanel2").hide();
                $("#replyFlip2").click(function () {
                    $("#replyPanel2").slideToggle("slow");
                });
            });

            
            
            /* Slide toggle Ends  */
            

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
