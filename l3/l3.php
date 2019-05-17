<?php

class Circle {
	public $full = "";
	public $radius = 0;

	public function __construct($rad) {
		$this->radius = $rad;
		$this->full = "Circle: a={$this->radius}";
	}
	function getSquare(){
		$sum = pow($this->radius, 2) * 3.14;
		return $sum;
	}
}

class Rectangle {
	public $full = "";
	public $length = 0;
	public $width = 0;

	public function __construct($len, $wid) {
		$this->width = $wid;
		$this->length = $len;
		$this->full = "Rectangle: a={$this->length}, b={$this->width}";
	}
	function getSquare(){
		$sum = 1;
		return $this->length * $this->width;
	}
}

class Pyramid {
	public $full = "";
	public $base = 0;
	public $thigh = 0;

	public function __construct($ba, $th) {
		$this->thigh = $th;
		$this->base = $ba;
		$this->full = "Pyramid: a={$this->base}, b={$this->thigh}";
	}
	function getSquare(){
		$sum = pow($this->base,2) + 2 * $this->base * sqrt(pow($this->thigh, 2) - pow($this->base,2) / 4);
		return $sum;
	}
}

// Generate random objects with random variables
function randomObj() { 
	$pyr = new Pyramid(rand(10,25),rand(10,25));
	$rec = new Rectangle(rand(10,99),rand(10,99));
	$cir = new Circle(rand(10,99));
	$list[] = $pyr;
	$list[] = $rec;
	$list[] = $cir;
	return $list[rand(0,2)];
}

// Save object to txt file
function saveTo($str) {
	$line = "\n";
	$str .= $line;
	$file = 'input.txt';
	file_put_contents($file, $str, FILE_APPEND);
}

// Get object from txt 
function getFrom() {
	$fd = fopen("input.txt", 'r') or die("не удалось открыть файл");
	while(!feof($fd))
	{
		$str = htmlentities(fgets($fd));
		$search = ':';
		$pos = strpos($str, $search);
		$name = substr($str, 0, $pos);
		if($name == "Circle") {
			$search = "a=";
			$pos = strpos($str, $search);
			$rad = substr($str, $pos+2);
			$cir = new Circle($rad);
			$list[] = $cir;
		}
		if($name == "Rectangle") {
			$search1 = "a=";
			$search2 = "b=";
			$pos1 = strpos($str, $search1);
			$pos2 = strpos($str, $search2);
			$wid = substr($str, $pos1+2, 2);
			$len = substr($str, $pos2+2);
			$rec = new Rectangle($wid, $len);
			$list[] = $rec;
		}
		if($name == "Pyramid") {
			$search1 = "a=";
			$search2 = "b=";
			$pos1 = strpos($str, $search1);
			$pos2 = strpos($str, $search2);
			$base = substr($str, $pos1+2, 2);
			$base = trim($base);
			$thigh = substr($str, $pos2+2);
			$pyr = new Pyramid($base, $thigh);
			$list[] = $pyr;
		}
	}
	fclose($fd);
	return $list;
}

$funcname = "getSquare";
saveTo(randomObj()->full);	// Save random object to file
$list = getFrom();

// Sort
for($i=0; $i < sizeof($list)-1; $i++){
	for($j=0; $j < sizeof($list)-1 - $i; $j++){
		if($list[$j]->$funcname() < $list[$j+1]->$funcname()){
			$temp = $list[$j];
			$list[$j] = $list[$j+1];
			$list[$j+1] = $temp;
		}
	}
}

//Output
foreach ($list as &$value) {
    echo $value->$funcname(), "\n", $value->full;
}
?>