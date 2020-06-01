<?php
    ob_start();
    session_start();
    //unset($_SESSION['user']);
    //echo $_SESSION['user'];
    if( isset($_SESSION['user'])!="" ){
        header("Location: home.php");
    }
    include_once 'dbconnect.php';

    $loginMsg="Login Here";
    $signupMsg="Sign Up For Free";
    $normalBox="";
    $errorBox="";


    //sign up codes********************************8
    $error = false;

    if ( isset($_POST['submit_btn']) ) {
  
        // clean user inputs to prevent sql injections
        $name = trim($_POST['username']);
        $name = strip_tags($name);
        $name = htmlspecialchars($name);
      
        $email = trim($_POST['email']);
        $email = strip_tags($email);
        $email = htmlspecialchars($email);
      
        $pass = trim($_POST['password']);
        $pass = strip_tags($pass);
        $pass = htmlspecialchars($pass);
        
        $firstName=$_POST['firstname'];
        $lastName=$_POST['lastname'];

        // basic name validation
        if (empty($name))
        {
            $error = true;
            $nameError = "Empty username is not applicable";
        } else if (strlen($name) < 3) 
        {
            $error = true;
            $nameError = "Name must have atleat 3 characters.";
        } else if (!preg_match("/^[a-zA-Z0-9]+$/",$name)) 
        {
            $error = true;
            $nameError = "Name must contain alphabets and digits with no spaces";
        }else
        {
            $query = "SELECT userName FROM user WHERE userName='$name'";
            $result = $conn->query($query);

            if($result->num_rows>0)
            {
                $error = true;
                $nameError = "username: '$name' is already in use.";
            }
        }
        if (empty($firstName))
        {
            $error = true;
            $firstNameError = "Empty first name is not applicable";
        } else if (!preg_match("/^[a-zA-Z]+$/",$firstName)) {
            $error = true;
            $firstNameError = "Name must contain alphabets with no spaces";
        }
        if (empty($lastName))
        {
            $error = true;
            $lastNameError = "Empty last name is not applicable";
        }else if (!preg_match("/^[a-zA-Z]+$/",$lastName)) {
            $error = true;
            $lastNameError = "Name must contain alphabets with no spaces";
        }
        
      
        //basic email validation
        if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) 
        {
            $error = true;
            $emailError = "Please enter valid email address.";
        } else {
            // check email exist or not
            $query = "SELECT email FROM user WHERE email='$email'";
            $result = $conn->query($query);
            if($result->num_rows>0)
            {
                $error = true;
                $emailError = "Provided Email is already in use.";
            }
        }
        // password validation
        if (empty($pass)){
            $error = true;
            $passError = "Please enter password.";
        } else if(strlen($pass) < 6) {
            $error = true;
            $passError = "Password must have atleast 6 characters.";
        }
      
      // password encrypt using SHA256();
        $password = hash('sha256', $pass);
      
      // if there's no error, continue to signup
        if( !$error ) {
       
            $query = "INSERT INTO `user`(`firstName`, `lastName`, `userName`, `email`, `password`, `user_id`, `dp`, `uup`, `udown`) VALUES
                                        ('$firstName','$lastName','$name','$email','$password','','','','')";
            $res = $conn->query($query);
            //echo $query;
        
            if ($res) {
                $errTyp = "success";
                $loginMsg = "Successfully registered,you may login now";
                unset($name);
                unset($email);
                unset($pass);
                unset($firstName);
                unset($lastName);
            } else 
            {
                $errTyp = "danger";
                $signupMsg = "Something went wrong, try again later..."; 
            } 

            //echo $errTyp;
            
        }
  
  
    }



    //login codes*********************************************************
    $loginError = false;
 
    if( isset($_POST['login_btn']) ) { 
  
        // prevent sql injections/ clear user invalid inputs
        $loginEmail = trim($_POST['login_email']);
        $loginEmail = strip_tags($loginEmail);
        $loginEmail = htmlspecialchars($loginEmail);
          
        $loginPass = trim($_POST['login_password']);
        $loginPass = strip_tags($loginPass);
        $loginPass = htmlspecialchars($loginPass);
        // prevent sql injections / clear user invalid inputs
          
        if(empty($loginEmail))
        {
            $loginError = true;
            $loginEmailError = "Please enter your email address.";
        } else if ( !filter_var($loginEmail,FILTER_VALIDATE_EMAIL) ) {
            $loginError = true;
           $loginEmailError = "Please enter valid email address.";
        }
      
        if(empty($loginPass)){
            $loginError = true;
            $loginPassError = "Please enter your password.";
        }
      
        // if there's no error, continue to login
        if (!$loginError) {
       
            $password = hash('sha256', $loginPass); // password hashing using SHA256
      
            $query = "SELECT * FROM `user` WHERE email='$loginEmail' AND password='$password' ";
            
            //echo $query;
            $result = $conn->query($query);
       
            if( $result->num_rows>0) {
                $row=$result->fetch_assoc();
                //echo "hoise";
                unset($loginEmail);
                unset($loginPass);
                //echo $row['userName'];
                $_SESSION['user'] = $row['userName'];
                $_SESSION['id']=$row['user_id'];
                header("Location: home.php");
            } else {
            $loginMsg = "Wrong email or password";
            $loginPassError=" ";
            $loginEmailError=" ";
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
        <title>Local Traveling Community</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
        <link type="text/css" rel="stylesheet" href="css/bootstrap.css">
        <link type="text/css" rel="stylesheet" href="css/bootstrap-theme.min.css">
        <link type="text/css" rel="stylesheet" href="css/style.css">
    </head>
    <body>


        <!-- Navigation -->
        <!--<div class="container-fluid navigation">
            <div class="container">
                <div class="col-sm-12 col-xs-6">
                    <div class="col-xs-12 col-sm-6">
                        <a href="index.html"><h1 class="title"><span class="fa fa-bus"></span> Bus Traveling Community</h1></a>
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
            </div>

        </div>-->
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
                                <li><a href="#">Search</a></li>
                                <li><a href="#">Ticket</a></li>
                                <li><a href="busprofile.php">Bus Info</a></li>
                                <li><a href="#">About Us</a></li>
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
        <!-- Log In Page -->
       <!-- <div class="container back_home">
            <a href="index.html"><< Back To Home</a>
        </div>-->
        

        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3 col-xs-12"></div>
                    <div class="col-sm-6 col-xs-12">
                        <div class="form">
                            <ul class="tab-group">
                                
                                <li class="tab <?php if(!isset($_POST['submit_btn']) || !$error) echo "active"; ?> "><a href="#login"><span class="glyphicon glyphicon-log-in"></span>  Log In</a></li>
                                <li class="tab <?php if(isset($_POST['submit_btn']) && $error) echo "active"; ?> "><a href="#signup"><span class="glyphicon glyphicon-edit"></span> Sign Up</a></li>

                            </ul>
                            <div class="tab-content">
                                <?php if(!isset($_POST['submit_btn']) || !$error) { ?>
                                <div id="login">
                                    <h1 class="text-center"><?php echo $loginMsg ?></h1><br/>
                                    <form action="#" method="post">
                                        <div class="form-group <?php 
                                                                        if(isset($loginEmailError))
                                                                            echo " has-error has-feedback";
                                                                    ?>"
                                        >
                                            <label class="control-label col-sm-4">Email: </label>
                                            <div class="col-sm-8 input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span><input class="form-control" type="email" name="login_email" placeholder="Enter your email address"/>
                                                <?php
                                                if(isset($loginEmailError)) { echo $loginEmailError; ?>
                                                <span class="glyphicon glyphicon-remove form-control-feedback"></span> <?php
                                                }?>
                                            </div>
                                            
                                        </div>
                                        <div class="form-group <?php 
                                                                        if(isset($loginPassError))
                                                                            echo " has-error has-feedback";
                                                                    ?>"
                                        >
                                            <label class="control-label col-sm-4">Password: </label>
                                            <div class="col-sm-8 input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span><input class="form-control" type="password" name="login_password" placeholder="Enter password"/>
                                                <?php
                                                if(isset($loginPassError)) { echo $loginPassError; ?>
                                                <span class="glyphicon glyphicon-remove form-control-feedback"></span> <?php
                                                }?>
                                            </div>
                                            
                                        </div>
                                       <!-- <div class=" form-group">
                                            <div class="checkbox">
                                                <label><input type="checkbox" value="keep_login" name="keep_login" checked>Remember me</label>
                                                <label class="fright">Forgot <a href="#">Password</a>?</label>
                                            </div>
                                        </div>-->
                                        <div class="login">
                                            <button type="submit"  value="Login" name="login_btn" class="login_button btn btn-block btn-lg"><span class="glyphicon glyphicon-off"></span> Log In</button>
                                        </div>
                                    </form>
                                </div> <?php } ?>
                                
                                <div id="signup">   
                                    <h1 class="text-center"><?php echo $signupMsg ?></h1><br/>

                                    <form class="form-horizontal" role="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                        <div class="form-group <?php 
															        if(isset($firstName))
															        	if(isset($firstNameError))
															        		echo " has-error has-feedback";
															        	else
															        		echo " has-success has-feedback";
															        ?>"
										>
                                            <label class="control-label col-sm-4" >First Name:</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" value="<?php if(isset($firstName
                                                ))echo $firstName?>" type="text" name="firstname" placeholder="Enter first name"  required=""/><br/>
                                                <?php 
											        if(isset($firstName))
											        	if(isset($firstNameError))
											        	{
											        		echo $firstNameError;
											        		echo "<span class=\"glyphicon glyphicon-remove form-control-feedback\"></span>";
											        	}
											        	else
											        	    echo "<span class=\"glyphicon glyphicon-ok form-control-feedback\"></span>";
											    ?>
                                            </div>
                                            
                                        </div>
                                        <div class="form-group <?php 
															        if(isset($lastName))
															        	if(isset($lastNameError))
															        		echo " has-error has-feedback";
															        	else
															        		echo " has-success has-feedback";
															        ?>"
										>
                                            <label class="control-label col-sm-4">Last Name:</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" value="<?php if(isset($lastName
                                                ))echo $lastName?>" type="text" name="lastname" placeholder="Enter last name"  /><br/>
                                                <?php 
											        if(isset($lastName))
											        	if(isset($lastNameError))
											        	{
											        		echo $lastNameError;
											        		echo "<span class=\"glyphicon glyphicon-remove form-control-feedback\"></span>";
											        	}
											        	else
											        	    echo "<span class=\"glyphicon glyphicon-ok form-control-feedback\"></span>";
											    ?>
                                            </div>
                                            
                                        </div>
                                        <div class="form-group <?php 
															        if(isset($name))
															        	if(isset($nameError))
															        		echo " has-error has-feedback";
															        	else
															        		echo " has-success has-feedback";
															        ?>"
										>
                                            <label class="control-label col-sm-4">User Name:</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" value="<?php if(isset($name
                                                ))echo $name?>" type="text" name="username" placeholder="Enter username" required="" /><br/>
                                                <?php 
											        if(isset($name))
											        	if(isset($nameError))
											        	{
											        		echo $nameError;
											        		echo "<span class=\"glyphicon glyphicon-remove form-control-feedback\"></span>";
											        	}
											        	else
											        	    echo "<span class=\"glyphicon glyphicon-ok form-control-feedback\"></span>";
											    ?>
                                            </div>
                                            
                                        </div>
                                        <div class="form-group <?php 
															        if(isset($email))
															        	if(isset($emailError))
															        		echo " has-error has-feedback";
															        	else
															        		echo " has-success has-feedback";
															        ?>"
										>
                                            <label class="control-label col-sm-4">Email:</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" value="<?php if(isset($email
                                                ))echo $email ?>" type="email" name="email" placeholder="Enter email"  required=""/><br/>
                                                <?php 
											        if(isset($email))
											        	if(isset($emailError))
											        	{
											        		echo $emailError;
											        		echo "<span class=\"glyphicon glyphicon-remove form-control-feedback\"></span>";
											        	}
											        	else
											        	    echo "<span class=\"glyphicon glyphicon-ok form-control-feedback\"></span>";
											    ?>
                                            </div>
                                            
                                        </div>
                                        <div class="form-group <?php 
															        if(isset($pass))
															        	if(isset($passError))
															        		echo " has-error has-feedback";
															        	else
															        		echo " has-success has-feedback";
															        ?>"
										>
                                            <label class="control-label col-sm-4">Password:</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="password" name="password" placeholder="Enter password"  required=""/><br/>
                                                <?php 
											        if(isset($pass))
											        	if(isset($passError))
											        	{
											        		echo $passError;
											        		echo "<span class=\"glyphicon glyphicon-remove form-control-feedback\"></span>";
											        	}
											        	else
											        	    echo "<span class=\"glyphicon glyphicon-ok form-control-feedback\"></span>";
											    ?>
                                            </div>
                                            
                                        </div>
                                       <!-- <div class="form-group">
                                            <label class="control-label col-sm-4">Phone Number:</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="text" name="phone" placeholder="Enter phone number"  required=""/><br/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-4">Address:</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="text" name="address" placeholder="Enter address"  required=""/><br/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-4">Gender:</label>
                                            <div class="col-sm-8">
                                                <select name="role" class="form-control">
                                                    <option value="male">Male</option>
                                                    <option value="female">Female</option>
                                                </select>
                                            </div>
                                        </div>-->



                                        <br><br>
                                        <div class="col-sm-6">
                                            <button type="submit" name="submit_btn" value="Submit" class="btn btn-success btn-lg btn-block"><i class="fa fa-check-square-o" aria-hidden="true"> Submit</i></button>
                                        </div>
                                        <div class="col-sm-6">
                                            <button type="button" class="btn btn-danger btn-lg btn-block"><span class="fa fa-undo"> Reset</span></button>
                                        </div>

                                        <br><br>

                                    </form>

                                </div>
                                <?php if(isset($_POST['submit_btn']) && $error) { ?>
                                <div id="login">
                                    <h1 class="text-center"><?php echo $loginMsg ?></h1><br/>
                                    <form action="#" method="post">
                                        <div class="form-group <?php 
                                                                        if(isset($loginEmailError))
                                                                            echo " has-error has-feedback";
                                                                    ?>"
                                        >
                                            <label class="control-label col-sm-4">Username: </label>
                                            <div class="col-sm-8 input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span><input class="form-control" type="email" name="login_email" placeholder="Enter your email address"/>
                                                <?php
                                                if(isset($loginEmailError)) { echo $loginEmailError; ?>
                                                <span class="glyphicon glyphicon-remove form-control-feedback"></span> <?php
                                                }?>
                                            </div>
                                            
                                        </div>
                                        <div class="form-group <?php 
                                                                        if(isset($loginPassError))
                                                                            echo " has-error has-feedback";
                                                                    ?>"
                                        >
                                            <label class="control-label col-sm-4">Password: </label>
                                            <div class="col-sm-8 input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span><input class="form-control" type="password" name="login_password" placeholder="Enter password"/>
                                                <?php
                                                if(isset($loginPassError)) { echo $loginPassError; ?>
                                                <span class="glyphicon glyphicon-remove form-control-feedback"></span> <?php
                                                }?>
                                            </div>
                                            
                                        </div>
                                       <!-- <div class=" form-group">
                                            <div class="checkbox">
                                                <label><input type="checkbox" value="keep_login" name="keep_login" checked>Remember me</label>
                                                <label class="fright">Forgot <a href="#">Password</a>?</label>
                                            </div>
                                        </div>-->
                                        <div class="login">
                                            <button type="submit"  value="Login" name="login_btn" class="login_button btn btn-block btn-lg"><span class="glyphicon glyphicon-off"></span> Log In</button>
                                        </div>
                                    </form>
                                </div> <?php  } ?>

                            </div>
                        </div>
                    </div>

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
                                <form >

                                    <div class="form-group">
                                        <label> Email Address </label>
                                        <input  type="email" placeholder="Enter your Email Address" name="email" class="form-control" required="">
                                    </div>
                                    <div class="form-group" >
                                        <label> Message </label>
                                        <textarea rows="5" class="form-control" name="message" placeholder="Type your query" required=""></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="button" class="btn btn-danger btn-block"> Send </button>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button class="close" data-dismiss="modal" >&times;</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Footer-->
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
                <div class="modal" id="shobuj">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="text-center">Sign Up!!</h1>
                            </div>
                            <div class="modal-body">
                                <form >

                                    <div class="form-group">
                                        <label for="email"> Email Address </label>
                                        <input  type="text" placeholder="Enter your Email Address" name="email" class="form-control">
                                    </div>
                                    <div class="form-group" >
                                        <label for="message"> Message </label>
                                        <textarea rows="5" class="form-control" name="message" placeholder="Type your query"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="button" class="btn btn-danger btn-block"> Send </button>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button class="close" data-dismiss="modal" >&times;</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <script src="js/jquery-1.11.3.min.js"></script>
        <script src="js/bootstrap.min.js"></script>

        <script>
            $('.tab a').on('click', function (e) {

                e.preventDefault();

                $(this).parent().addClass('active');
                $(this).parent().siblings().removeClass('active');

                target = $(this).attr('href');

                $('.tab-content > div').not(target).hide();

                $(target).fadeIn(600);

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
                $("#datepicker").datepicker();
            });
            $(function () {
                $("#datepicker2").datepicker();
            });
        </script>
        <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

    </body>
</html>

<?php ob_end_flush(); ?>