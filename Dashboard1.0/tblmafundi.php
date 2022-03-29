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
	$sql="CREATE TABLE `tblmafundi` (
		`id`  int AUTO_INCREMENT PRIMARY KEY,
	  `first_name` text NOT NULL,
	  `last_name` text NOT NULL,
	  `id_number` int NOT NULL,
	  `phone` int NOT NULL,
	  `town` text NOT NULL,
	  `trade_type` text NOT NULL,
		`fundi_type` text NOT NULL,
	  `comments` text NOT NULL,
	  `status` text NOT NULL,
		`entry_date` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP

	) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


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
