
<?php
	session_start();
	include_once 'dbconnect.php';
	$id=-1;
	$date="";
	$source="";
	$destination="";
	if(isset($_GET['id']) && isset($_GET['date']) && isset($_GET['source']) && isset($_GET['des']))
	{
		$id=$_GET['id'];
		$date=$_GET['date'];
		$source=$_GET['source'];
		$destination=$_GET['des'];
	}
	$q="SELECT seat_price FROM `bus` WHERE bus_id=$id";
	$result=$conn->query($q);
	$row=$result->fetch_assoc();
	$price=$row['seat_price'];
	//echo $price;

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>BTC</title>
<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="jquery.seat-charts.css">
 <!--tahi-->
       <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
        <link type="text/css" rel="stylesheet" href="css/bootstrap.css">
        <link type="text/css" rel="stylesheet" href="css/bootstrap-theme.min.css">
        <link type="text/css" rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <!--tahi-->
<style>
body {
	font-family: 'Roboto', sans-serif;
  background-color:#fafafa;
}
a {
	color: #b71a4c;
}
.front-indicator {
	width: 145px;
	margin: 5px 32px 15px 32px;
	background-color: #f6f6f6;	
	color: #adadad;
	text-align: center;
	padding: 3px;
	border-radius: 5px;
}
.wrapper {
	width: 100%;
	text-align: center;
  margin-top:150px;
}
.container {
	margin: 0 auto;
	width: 500px;
	text-align: left;
}
.booking-details {
	float: left;
	text-align: left;
	margin-left: 35px;
	font-size: 12px;
	position: relative;
	height: 401px;
}
.booking-details h2 {
	margin: 25px 0 20px 0;
	font-size: 17px;
}
.booking-details h3 {
	margin: 5px 5px 0 0;
	font-size: 14px;
}
div.seatCharts-cell {
	color: #182C4E;
	height: 25px;
	width: 25px;
	line-height: 25px;
	
}
div.seatCharts-seat {
	color: #FFFFFF;
	cursor: pointer;	
}
div.seatCharts-row {
	height: 35px;
}
div.seatCharts-seat.available {
	background-color: #B9DEA0;

}
div.seatCharts-seat.available.first-class {
/* 	background: url(vip.png); */
	background-color: #3a78c3;
}
div.seatCharts-seat.focused {
	background-color: #76B474;
}
div.seatCharts-seat.selected {
	background-color: #E6CAC4;
}
div.seatCharts-seat.unavailable {
	background-color: #472B34;
}
div.seatCharts-container {
	border-right: 1px dotted #adadad;
	width: 200px;
	padding: 20px;
	float: left;
}
div.seatCharts-legend {
	padding-left: 0px;
	position: absolute;
	bottom: 16px;
}
ul.seatCharts-legendList {
	padding-left: 0px;
}
span.seatCharts-legendDescription {
	margin-left: 5px;
	line-height: 30px;
}
.checkout-button {
	display: block;
	margin: 10px 0;
	font-size: 14px;
}
#selected-seats {
	max-height: 90px;
	overflow-y: scroll;
	overflow-x: none;
	width: 170px;
}
.head {
	background: #444;
	padding-top: 10px;
	padding-bottom: 10px;
}
.head ul{
	list-style-type: none;
}
.head ul li{
	display: inline;
}
.head ul li a {
	background: #444;
	color: oldlace;
    text-decoration: none;
    
    
    font-family: paragraph;
    font-size: 15px;
    letter-spacing: 1px;
}
.head_logo {
	font-size: 25px;
	font-weight: bold;
	margin-right: 5px;
}
.back_home{
	float:left;
}
input[type=text] {
    
    padding: 6px 20px;
    margin: 4px 0;
    box-sizing: border-box;
    border: 3px solid #ccc;
    -webkit-transition: 0.2s;
    transition: 0.2s;
    outline: none;
}

input[type=text]:focus {
    border: 6px solid #555;
}

</style>
</head>

<body>
 <!-- Navigation -->
<div class="head">
<ul>
     <li><a href="../home.php"><span  class="head_logo">Bus Traveling Community</span></a></li>
     <br>
     <li class="back_home"><a href="../home.php">Home</a></li>
 </ul>
 </div>


<div class="wrapper" id='hider' >
  <div class="container" >
  <h1>Select Seats ||| Passenger Detail</h1> 
    <div id="seat-map" >
      <div class="front-indicator">Front</div>
    </div>

    
    <form id="form">
    <input type="text" placeholder="Passenger Name" id="name" required="" class="input">
    <input type="text" placeholder="Mobile No" id="mobile" required="">
    <input type="text" placeholder="Email" id="email" required="">
    <div>
    	<input type="radio" name="gender" value="male" checked> Male
  		<input type="radio" name="gender" value="female"> Female<br>
  	</div>

    <div class="booking-details" >
      <h2>Booking Details</h2>
      <h3> Selected Seats (<span id="counter">0</span>):</h3>
      <ul id="selected-seats">
      </ul>
      Total: <b>TK: <span id="total">0</span></b>
      <button class="checkout-button" id="confirm">Checkout &raquo;</button>
     
      <div id="legend"></div>
      
    </div>
    </form>
  </div>
</div>


<form id="tmpForm" method="post" action="../confirm_ticket.php">
	<input type="hidden" name="tmpname" 		id="TMPname" 			>
	<input type="hidden" name="tmpemail"		id="TMPemail"			>
	<input type="hidden" name="tmpmobile"		id="TMPmobile"			>
	<input type="hidden" name="tmpgender"		id="TMPgender"			>
	<input type="hidden" name="tmpdate"			id="TMPdate"			>
	<input type="hidden" name="tmpsource"		id="TMPsource"			>
	<input type="hidden" name="tmpdestination"	id="TMPdestination"			>
	<input type="hidden" name="tmptotal"		id="TMPtotal"			>
	<input type="hidden" name="tmpdeptTime"		id="TMPdeptTime"			>
	<input type="hidden" name="tmparrTime"		id="TMParrTime"			>
	<input type="hidden" name="tmptype"			id="TMPtype"			>
	<input type="hidden" name="tmpbusName"		id="TMPbusName"			>
</form>

</body>




<script src="http://code.jquery.com/jquery-1.12.4.min.js"></script> 
<script src="jquery.seat-charts.js"></script> 
<script>
			var firstSeatLabel = 1;
			var busID = "<?php echo $id; ?>";
			var date="<?php echo $date; ?>";
			var pricee=parseInt("<?php echo $price; ?>");
			var source="<?php echo $source; ?>";
			var des=("<?php echo $destination; ?>");
			
			$('#next').hide();
			
			$(document).ready(function() {
				var $cart = $('#selected-seats'),
					$counter = $('#counter'),
					$total = $('#total'),
					sc = $('#seat-map').seatCharts({
					map: [
						'ee_ee',
						'ee_ee',
						'ee_ee',
						'ee_ee',
						'ee_ee',
						'ee_ee',
						'ee_ee',
						'ee_ee',
						'ee_ee',
						'ee_ee',
					],
					seats: {
						f: {
							price   : 100,
							classes : 'first-class', //your custom CSS class
							category: 'First Class'
						},
						e: {
							price   : pricee,
							classes : 'economy-class', //your custom CSS class
							category: 'Economy Class'
						}					
					
					},
					naming : {
						top : false,
						getLabel : function (character, row, column) {
							return firstSeatLabel++;
						},
					},
					legend : {
						node : $('#legend'),
					    items : [
							
							[ 'e', 'available',   'Available'],
							[ 'f', 'unavailable', 'Already Booked']
					    ]					
					},
					click: function () {
						if (this.status() == 'available') {
							//let's create a new <li> which we'll add to the cart items
							$('<li>'+this.data().category+' Seat # '+this.settings.label+': <b>TK: '+this.data().price+'</b> <a href="#" class="cancel-cart-item">[cancel]</a></li>')
								.attr('id', 'cart-item-'+this.settings.id)
								.data('seatId', this.settings.id)
								.appendTo($cart);
							
							/*
							 * Lets update the counter and total
							 *
							 * .find function will not find the current seat, because it will change its stauts only after return
							 * 'selected'. This is why we have to add 1 to the length and the current seat price to the total.
							 */
							$counter.text(sc.find('selected').length+1);
							$total.text(recalculateTotal(sc)+this.data().price);
							
							return 'selected';
						} else if (this.status() == 'selected') {
							//update the counter
							$counter.text(sc.find('selected').length-1);
							//and total
							$total.text(recalculateTotal(sc)-this.data().price);
						
							//remove the item from our cart
							$('#cart-item-'+this.settings.id).remove();
						
							//seat has been vacated
							return 'available';
						} else if (this.status() == 'unavailable') {
							//seat has been already booked
							return 'unavailable';
						} else {
							return this.style();
						}
					}
				});

				//this will handle "[cancel]" link clicks
				$('#selected-seats').on('click', '.cancel-cart-item', function () {
					//let's just trigger Click event on the appropriate seat, so we don't have to repeat the logic here
					sc.get($(this).parents('li:first').data('seatId')).click();
				});

				//let's pretend some seats have already been booked
				//sc.get(['1_2', '4_1', '7_1', '7_2']).status('unavailable');
							//sc.status('4_2', 'unavailable');
	//var sc = $('#seat-map').seatCharts();
								$.ajax({
								type     : 'get',
								url      : 'seats.php?id='+busID+'&date='+date,
								dataType : 'json',
								success  : function(response) {
								//iterate through all bookings for our event 
								$.each(response, function(index, booking) {
									//find seat by id and set its status to unavailable
									//window.alert(response[index]);
									sc.status(response[index],'unavailable');
									});
											//var myObj = JSON.parse(response);

									
											}
								});

					    	setInterval(function() {
					    	//window.alert("goa");
					    		$.ajax({
								type     : 'get',
								url      : 'seats.php?id='+busID+'&date='+date,
								dataType : 'json',
								success  : function(response) {
								//iterate through all bookings for our event 
								$.each(response, function(index, booking) {
									//find seat by id and set its status to unavailable
									//window.alert(response[index]);
									sc.status(response[index],'unavailable');
									});
											//var myObj = JSON.parse(response);

									
											}
								});

					    		}, 1000);


			$('#confirm').click(function(){
				$("#form").submit(function(e){
       			 e.preventDefault();
    			});
				
				var seats=[];
				var price=parseInt($('#total').text());
				var name,email,mobile,gender;
				
				$('#selected-seats').children().each(function(){
					seats.push($(this).attr("id").substring(10,14));
				})
				if(seats.length==0)
				{
					window.alert("Please select a seat");
				}
				else if($('#name').val()=="" || $('#email').val()=="" || $('#mobile').val()=="")
				{

				}
				//var name =$('#name').val(),email=$('#email').val(),mobile = $('#mobile').val();
				//window.alert(name+email+mobile);
				else
				{
					name =$('#name').val();
					email=$('#email').val();
					mobile = $('#mobile').val();
					gender=$('input[name=gender]:checked').val();



					var jsonStringSeats = JSON.stringify(seats);

					$.ajax({
								type     : 'post',
								url      : 'confirm_book.php?',
								data     : {seats : jsonStringSeats,
											name : name,
											email : email,
											mobile : mobile,
											gender : gender,
											price : $('#total').text(),
											id : busID,
											date : date,
											source : source,
											des : des
											},
				//$ans=array($name,$email,$mobile,$gender,$date,$source,$destination,$total,$deptTime,$arrTime,$type,$busName);
								dataType : 'json',
								success  : function(response) {
										//window.alert(response[0]);
										$('#TMPname').val(response[0]);
										$('#TMPemail').val(response[1]);
										$('#TMPmobile').val(response[2]);
										$('#TMPgender').val(response[3]);
										$('#TMPdate').val(response[4]);
										$('#TMPsource').val(response[5]);
										$('#TMPdestination').val(response[6]);
										$('#TMPtotal').val(response[7]);
										$('#TMPdeptTime').val(response[8]);
										$('#TMParrTime').val(response[9]);
										$('#TMPtype').val(response[10]);
										$('#TMPbusName').val(response[11]);
										//window.alert(response[11]);
										$('#tmpForm').submit();
									}
								});

					//window.alert(gender);
				}
				
				//$('#next').show();


				//ajax

				
				//window.alert("haha");




				//ajax end




				

			});



		
		});


		function recalculateTotal(sc) {
			var total = 0;
		
			//basically find every selected seat and sum its price
			sc.find('selected').each(function () {
				total += this.data().price;
			});
			
			return total;
		}
		
		</script>


		<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();




</script>

</html>
