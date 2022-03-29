<?php
$servername="localhost";
$username="root";
$password="";
$dbname="db_huduma";

try{
	//create connection to servername
	$conn=new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
	//set errormode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	//create table
	$sql="CREATE TABLE `tblenquiries` (

	`enquiry_id`  int AUTO_INCREMENT PRIMARY KEY,
  `enquiry` text NOT NULL,
  `enquiry_type` text NOT NULL,
  `enquiry_trackno` text NOT NULL,
  `application_date` text NOT NULL,
  `phone` text NOT NULL,
  `email` text NOT NULL,
  `comments` text NOT NULL,
	`entry_date` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;10

	)";

	//use exec()to execute
	$conn->exec($sql);
	echo "Table created successfully!";
}
catch(PDOException $e)
{echo $sql."<br>".$e->getMessage();}
//end connection
$conn=null;
?>
