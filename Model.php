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
			function add_model()
				{
					$('#loader').css("display","block");
					//alert("success");
					var manufacture=$("#manufacture").val();
					var model=$("#model").val();
					var quantity=$("#quantity").val();
					var isValid = true;
					var counter = 0;
					var alphabets = /^[a-zA-Z]*$/;
					$('.compul').each(function() {
						if ($.trim($(this).val()) == '') {
							counter++;
							if (counter == 1) {
								$(this).focus();
							}
							isValid = false;
							$(this).css({
								"border": "2px solid #d0992c",
								"color": "#636466"
							});
						} else {
							$(this).css({
								"border": ""
							});
						}
					});
					if (isValid == false) {
						alert('Fields marked are important');
						return false;
					}
					
					if(quantity.match(alphabets)){
						alert('Please enter only Number');
						$("#quantity").css({
							"border": "2px solid #d0992c",
							"color": "#636466"
						});
						$("#quantity").focus();
						return false;
					} else {
						$("#quantity").css({
							"border": ""
						});
					} 
					
					$.ajax
					({
						type:'post',
						url:'back.php',				
						data:
							{
								do_model:"do_model",
								manufacture:manufacture,
								model:model,
								quantity:quantity,
							},
						success:function(response) 
							{
								if(response=="success")
								{
									alert('Model Successfully Added');
									window.location.href="Model.php";
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
			
			#manufacture,#quantity,#submit{
				width: 15%;
				padding: 12px;
				border: 1px solid #ccc;
				border-radius: 4px;
				resize: vertical;
			}
			
			#model{
				width: 20%;
				padding: 12px;
				border: 1px solid #ccc;
				border-radius: 4px;
				resize: vertical;
			}
		</style>
	</head>
	<body>
		<img src="loader.gif" class="loader" id="loader" style="position: fixed;margin-left: 37em;margin-top: 8em;display:none;" />
		<ul>
			<h1>MENU</h1>
			<li><a  href="index.php">Home</a></li>
			<li><a href="Manufacture.php">Add Manufacture</a></li>
			<li><a class="active" href="Model.php">Add Model</a></li>
		</ul>
		<div style="margin-left:25%;padding:1px 16px;height:1000px;">
		<h1>CAR INVENTORY MANAGEMENT</h1>
		<form onSubmit="add_model(); return false;" style="font-size: 20px;">
			Select Manufacture * : 
			<select name="manufacture" id="manufacture" class="compul">
				<option value="">Please Select Manufacture</option>
				<?php
					$selectmanufacture = "select * from tbl_manufacture";
					$select_data=mysqli_query($mysqlConnection,$selectmanufacture);
					while($row=mysqli_fetch_array($select_data))
					{
				?>
				<option value="<?php echo $row["id"]; ?>"><?php echo $row["manufacture_name"]; ?></option>
				<?php } ?>
			</select>
			Model Name *: 
			<input type="text" name="model" id="model" class="compul" placeholder="Model Name" />
			Quantity * : 
			<input type="text" name="quantity" id="quantity" class="compul" placeholder="Quantity" /><br /><br /><br />
			<center><button name="submit" id="submit" value="submit">Submit</button></center>
			<br /><span style="font-size: 12px;color: red;">*Field marks are important</span>
		</form>
		</div>
	</body>
</html>