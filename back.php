<?php

require_once  'db_connect.php';

// connecting to db
$db = new DB_CONNECT();

$mysqlConnection = $db->connect();
if(isset($_POST['do_manufacture'])) 		
	{
		$manufacture=$_POST['manufacture'];
		//echo $manufacture;
		//die;
		$alreadyexist = "select * from tbl_manufacture where manufacture_name='$manufacture'";
		$select_alreadyexist=mysqli_query($mysqlConnection,$alreadyexist);	
		if(mysqli_num_rows($select_alreadyexist) > 0)
		{
				echo "already";
		}
		else{
		$query="INSERT INTO `tbl_manufacture`(`manufacture_name`) VALUES ('$manufacture')";
		$select_data=mysqli_query($mysqlConnection,$query);		
		if($select_data == true)
			{
				echo "success";
			}
		else
			{
				echo "fail";
			}
		}
	}

if(isset($_POST['do_model'])) 		
	{
		$manufacture=$_POST['manufacture'];
		$model=$_POST['model'];
		$quantity=$_POST['quantity'];
		//echo $manufacture;
		//die;
		$query="INSERT INTO `tbl_model`(`manufacture_id`,`model_name`,`quantity`) VALUES ('$manufacture','$model','$quantity')";
		$select_data=mysqli_query($mysqlConnection,$query);		
		if($select_data == true)
			{
				echo "success";
			}
		else
			{
				echo "fail";
			}
	}

if(isset($_POST['do_sold'])) 		
	{		
		$id=$_POST['id'];		
		//echo $manufacture;
		//die;
		$selectquntity = "select quantity from tbl_model WHERE id='$id'";
		$select_dataquantity=mysqli_query($mysqlConnection,$selectquntity);	
		$row=mysqli_fetch_array($select_dataquantity);
		$quantity = $row["quantity"];
		if($quantity == 1)
		{
			$deletemodel = "DELETE FROM `tbl_model` WHERE id='$id'";
			$select_data=mysqli_query($mysqlConnection,$deletemodel);	
		}
		else
		{
			$finalquantity = $quantity - 1 ; 
			$updatemodel = "UPDATE `tbl_model` SET `quantity`= '$finalquantity' WHERE id='$id'";
			$select_data=mysqli_query($mysqlConnection,$updatemodel);
		}
		if($select_data == true)
			{
				echo "success";
			}
		else
			{
				echo "fail";
			}
	}
?>