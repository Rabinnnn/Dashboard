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
	$sql="	CREATE TABLE `tblprojects` (
		`id`  int AUTO_INCREMENT PRIMARY KEY,
	  `project_name` text NOT NULL,
	  `project_id` text NOT NULL,
	  `developer_name` text NOT NULL,
	  `contractor_reg` text NOT NULL,
	  `start_date` text NOT NULL,
	  `phone` text NOT NULL,
	  `email` text NOT NULL,
	  `comment` text NOT NULL,
	  `project_type` text NOT NULL,
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
