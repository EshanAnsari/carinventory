<?php
require_once  'db_connect.php';
$db = new DB_CONNECT();
$mysqlConnection = $db->connect();
?>
<html>
	<head>
		<title>
			Car Inventory
		</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script>
			function sold(id)
				{
					$('#loader').css("display","block");
					//alert("success");
					var id = id;
					//alert(id);
					$.ajax
					({
						type:'post',
						url:'back.php',				
						data:
							{
								do_sold:"do_sold",
								id:id,								
							},
						success:function(response) 
							{
								if(response=="success")
								{
									alert('Successfully Sold');
									window.location.href="index.php";
								}								
								else
								{		
									alert('Something went wrong');
								}
							}
					});
				}
		</script>
		<style>
			body {
			  margin: 0;
			}

			ul {
			  list-style-type: none;
			  margin: 0;
			  padding: 0;
			  width: 25%;
			  background-color: #f1f1f1;
			  position: fixed;
			  height: 100%;
			  overflow: auto;
			}

			li a {
			  display: block;
			  color: #000;
			  padding: 8px 16px;
			  text-decoration: none;
			}

			li a.active {
			  background-color: #4CAF50;
			  color: white;
			}

			li a:hover:not(.active) {
			  background-color: #555;
			  color: white;
			}
		</style>
	</head>
	<body>
		<img src="loader.gif" class="loader" id="loader" style="position: fixed;margin-left: 37em;margin-top: 8em;display:none;" />
		<ul>		
			<h1>MENU</h1>
			<li><a class="active" href="index.php">Home</a></li>
			<li><a href="Manufacture.php">Add Manufacture</a></li>
			<li><a href="Model.php">Add Model</a></li>			
		</ul>
		<div style="margin-left:25%;padding:1px 16px;height:1000px;">
		<h1>CAR INVENTORY MANAGEMENT</h1>
		<table border="1">
			<thead>
				<tr>                                         
					<th>Sr.No</th>
					<th>Manufacture Name</th>
					<th>Model</th>
					<th>Quantity</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>	
			<?php
				$counter = 1;
				$selectdetails = "select * from tbl_model";
				$select_data=mysqli_query($mysqlConnection,$selectdetails);
				while($row=mysqli_fetch_array($select_data))
				{
			?>
				<tr >
					<td><?php echo $counter++; ?></td>
					<td>
					<?php 
					$manufactureid = $row["manufacture_id"];
					$selectmanufacture = "select manufacture_name from tbl_manufacture WHERE id='$manufactureid'";
					$select_datamanufacture=mysqli_query($mysqlConnection,$selectmanufacture);
					$rowmanu=mysqli_fetch_array($select_datamanufacture);
					echo $rowmanu["manufacture_name"];
					?>
					</td>
					<td><?php echo $row["model_name"]; ?></td>
					<td><?php echo $row["quantity"]; ?></td>
					<td><button name="sold" id="sold" onclick="sold('<?php echo $row["id"];  ?>');">Sold</button></td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
		</div>
	</body>
</html>