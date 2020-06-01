
<?php
	session_start();
	include_once 'dbconnect.php';

	$seats = json_decode(stripslashes($_POST['seats']));
	$name=$_POST['name'];
	$email=$_POST['email'];
	$mobile=$_POST['mobile'];
	$gender= $_POST['gender'];
	$price = $_POST['price'];
	$busID = $_POST['id'];
	$date = $_POST['date'];
	$source = $_POST['source'];
	$destination = $_POST['des'];
	$total=intval($price);
	


	$q="INSERT INTO `passenger`(`passenger_id`, `contact`, `passenger_name`, `email`, `gender`) VALUES (NULL,'$mobile','$name','$email','$gender')";
	$result=$conn->query($q);
	$passengerID=$conn->insert_id;

	$q="INSERT INTO `ticket`(`ticket_id`, `travel_date`, `booking_time`, `confirm`, `price`, `remaining_time`) VALUES (NULL,'$date',NULL,0,$total,'')";
	$result=$conn->query($q);
	$ticketID=$conn->insert_id;



	//$ans=array();
	  // here i would like use foreach:
	$seatArray="";
	foreach($seats as $d){
	     //array_push($ans,$d);
	  		$q="INSERT INTO `seats_of_ticket`(`ticket_id`, `seat_no`) VALUES ($ticketID,'$d')";
	  		$result=$conn->query($q);
	  		$seatArray=$seatArray. $d.",";
	}
	  //array_push($ans,$_POST['name']);

	$q="INSERT INTO `buys`(`buys_id`, `passengerID`, `ticketID`) VALUES (NULL,$passengerID,$ticketID)";
	$conn->query($q);
	$q="INSERT INTO `isbooked_for`(`isbooked_for_id`, `busID`, `ticketID`) VALUES (NULL,$busID,$ticketID)";
	$conn->query($q);

	$q="SELECT `bus_name`, `departure_time`, `arrival_time`, `type` FROM `bus` WHERE bus_id=$busID";
	$result=$conn->query($q);
	$row=$result->fetch_assoc();
	$deptTime=$row['departure_time'];
	$arrTime=$row['arrival_time'];
	$type=$row['type'];
	$busName=$row['bus_name'];
	$ans=array($name,$email,$mobile,$gender,$date,$source,$destination,$total,$deptTime,$arrTime,$type,$busName);

/*class ticket implements JsonSerializable
{
    public $name;
    public $phonenr;
    public $email;
    public $total;
    public $source;
    public $destination;
    public $date;
    public $deptTime;
    public $arrTime;
    public $seats;
    public $busName;
    public $type;

    public $accessible = array('name', 'phonenr', 'email', 'total', 'source', 'destination', 'date', 'deptTime', 'arrTime','seats','busName','type');
    public $editable = array('name', 'phonenr', 'email', 'total', 'source', 'destination', 'date', 'deptTime', 'arrTime','seats','busName','type');
    public $required = array('name');

//getter, setter, constructor

    public function jsonSerialize(){
        return ['name' => $this->name,
            'phonenr'=>$this->phonenr,
            'email'=>$this->email,
            'total'=>$this->total,
            'source'=>$this->source,
            'destination'=>$this->destination,
            'date'=>$this->date,
            'deptTime'=>$this->deptTime,
            'arrTime'=>$this->arrTime,
            'seats'=>$this->seats,
            'busName'=>$this->busName,
            'type'=>$this->type
        ];
    }
}
$t= new ticket();
$t->$name=$name;
$t->$phonenr=$mobile;
$t->$email=$mobile;
$t->$total=$total;
$t->$source=$source;
$t->$destination=$destination;
$t->$date=$date;
$t->$deptTime=$deptTime;
$t->$arrTime=$arrTime;
$t->$seats=$seatArray;
$t->$busName=$busName;
$t->$type=$type;
//$obj=json_encode($t);
	//echo $obj;


echo "";
*/


echo json_encode($ans);

?>