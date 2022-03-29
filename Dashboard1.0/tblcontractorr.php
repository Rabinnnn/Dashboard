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
	$sql="CREATE TABLE `tblcontractor`(
	`id`  int AUTO_INCREMENT PRIMARY KEY,
  `contractor_name` text NOT NULL,
  `bw_reg` text,
  `bw_category` text,
  `bw_date` text,
  `rw_reg` text,
  `rw_category` text,
  `rw_date` text,
  `ww_reg` text,
  `ww_category` text,
  `ww_date` text,
  `ees_reg` text,
  `ees_category` text,
  `ees_date` text,
  `mes_reg` text,
  `mes_category` text,
  `mes_date` text,
  `phone` text,
  `email` text,
  `comments` text,
  `status` text,
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
