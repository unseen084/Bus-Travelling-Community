<?php
session_start();
include_once 'dbconnect.php';
$uid=0;$usname;
if(!isset($_SESSION['id']) && !isset($_SESSION['user'])) header('Location: review.php');

if(isset($_GET['user']) && isset($_GET['uid'])){
    
    $usname = $_GET['user'];
    $uid = $_GET['uid'];
}
else if(isset($_SESSION['user'])){
    $usname = $_SESSION['user'];
    $uid = $_SESSION['id'];
}
/*if(!isset($_FILES['userfile']))
{
    //echo '<p>Please select a file</p>';
}
else
{
    try {
    $msg= upload();  //this will upload your image
    echo $msg;  //Message showing success or failure.
    }
    catch(Exception $e) {
    echo $e->getMessage();
    echo 'Sorry, could not upload file';
    }
}

// the upload function

function upload() {
    $maxsize = 10000000; //set to approx 10 MB

    //check associated error code
    if($_FILES['userfile']['error']==UPLOAD_ERR_OK) {

        //check whether file is uploaded with HTTP POST
        if(is_uploaded_file($_FILES['userfile']['tmp_name'])) {    

            //checks size of uploaded image on server side
            if( $_FILES['userfile']['size'] < $maxsize) {  
  
               //checks whether uploaded file is of image type
              //if(strpos(mime_content_type($_FILES['userfile']['tmp_name']),"image")===0) {
                 $finfo = finfo_open(FILEINFO_MIME_TYPE);
                if(strpos(finfo_file($finfo, $_FILES['userfile']['tmp_name']),"image")===0) {    

                    // prepare the image for insertion
                    $imgData =addslashes (file_get_contents($_FILES['userfile']['tmp_name']));

                    
                    
                    //echo $imgData;
                    $sql = "UPDATE user SET dp = :imgData WHERE user_id=11";
                    $stmt = $this->pdo->prepare($sql);
                    $stmt->bindParam(':imgData',$blob, PDO::PARAM_LOB);
                    $stmt->execute();
                    // insert the image
                    
                    $msg='<p>Image successfully saved</p>';
                }
                else
                    $msg="<p>Uploaded file is not an image.</p>";
            }
             else {
                // if the file is not less than the maximum allowed, print an error
                $msg='<div>File exceeds the Maximum File limit</div>
                <div>Maximum File limit is '.$maxsize.' bytes</div>
                <div>File '.$_FILES['userfile']['name'].' is '.$_FILES['userfile']['size'].
                ' bytes</div><hr />';
                }
        }
        else
            $msg="File not uploaded successfully.";

    }
    else {
        $msg= file_upload_error_message($_FILES['userfile']['error']);
    }
    return $msg;
}

// Function to return error message based on error code

function file_upload_error_message($error_code) {
    switch ($error_code) {
        case UPLOAD_ERR_INI_SIZE:
            return 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
        case UPLOAD_ERR_FORM_SIZE:
            return 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
        case UPLOAD_ERR_PARTIAL:
            return 'The uploaded file was only partially uploaded';
        case UPLOAD_ERR_NO_FILE:
            return 'No file was uploaded';
        case UPLOAD_ERR_NO_TMP_DIR:
            return 'Missing a temporary folder';
        case UPLOAD_ERR_CANT_WRITE:
            return 'Failed to write file to disk';
        case UPLOAD_ERR_EXTENSION:
            return 'File upload stopped by extension';
        default:
            return 'Unknown upload error';
    }
}*/

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
                                <li><a href="ticket.html">Ticket</a></li>
                                <li><a href="busprofile.php">Bus Info</a></li>
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
                                        if(isset($_SESSION['id'])==$uid)
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

                <div class="container-fluid">
                    <div class="container">
                        <br><br>
                        <h1 class="text-uppercase hd text-center">User Profile</h1>
                        <div class="row">
                            <br>

                            <hr>
                            <div class="col-sm-6 col-xs-12">
                                <div class="col-sm-12 col-xs-12">
                                    <?php
                                    
                                    $sql = "SELECT * FROM user WHERE user_id=$uid";
                                    $res = $conn->query($sql);
                                    $ret = $res->fetch_assoc();
                                    $uV=$ret['uup'];
                                    $dV=$ret['udown'];
                                    $fN = $ret['firstName'];
                                    $lN = $ret['lastName'];
                                    $uN = $ret['userName'];
                                    $mail = $ret['email'];
                                    if($uV+$dV!=0) $rate = ($uV*5)/($uV+$dV);
                                    else $rate=0;
                                    ?>
                                    <h3><font color="red">Contribution: </font><?php echo (int)$rate," " ?><span class=" fa fa-star"></span></h3>
                                    <img src="images/abc1.jpg" class="img-thumbnail" alt="Profile Picture" width="304" height="236">
                                </div>
                                <div class="col-sm-12 col-xs-12">
                                    <div class="col-sm-7">
                                        <?php if($_SESSION['user']==$usname){?>
                                        <form role="form" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <br>
                                                <label>Upload your photo:</label>
                                                <input class="form-control" type="file" name="userfile"/>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" name="submit" value="" class="btn btn-success"><i class="glyphicon glyphicon-open"></i> Upload</button>
                                            </div>
                                        </form><?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <br><br><br><br><br><br>
                                <h4><span class="info">First Name:</span> <?php echo $fN ?></h4>
                                <h4><span class="info">Last Name: </span> <?php echo $lN ?> </h4>
                                <h4><span class="info">User Name:</span> <?php echo $uN ?></h4>
                                <h4><span class="info">Email:</span> <?php echo $mail ?></h4>
                                
                                <hr>
                                <!--<a href="#"><button class="btn btn-warning"><i class="glyphicon glyphicon-edit"></i> Edit Info</button></a>
                                <a href="#" class="fright back"><i class="glyphicon glyphicon-backward"></i> Go <b>Back</b> to Employee Status</a>-->
                            </div>
                        </div>


                    </div>
                </div>






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
