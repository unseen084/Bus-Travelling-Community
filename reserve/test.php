<?php
    class ticket implements JsonSerializable
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
$obj=json_encode($t);
	echo $obj;
?>