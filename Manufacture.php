<html>
	<head>
		<title>
			Car Inventory
		</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script>
			function add_manufacture()
				{
					$('#loader').css("display","block");
					//alert("success");
					var manufacture=$("#manufacture").val();
					var isValid = true;
					var counter = 0;
					$('#manufacture').each(function() {
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
					
					
					$.ajax
					({
						type:'post',
						url:'back.php',				
						data:
							{
								do_manufacture:"do_manufacture",
								manufacture:manufacture,
							},
						success:function(response) 
							{
								if(response=="success")
								{
									alert('Manufacture Name Successfully Added');
									window.location.href="Manufacture.php";
								}
								else if(response=="already")
								{
									alert('Manufacture Name Already Exist');
									$('#loader').css("display","none");
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
			
			#manufacture{
				width: 50%;
				padding: 12px;
				border: 1px solid #ccc;
				border-radius: 4px;
				resize: vertical;
			}
			
			#submit{
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
			<li><a class="active" href="Manufacture.php">Add Manufacture</a></li>
			<li><a href="Model.php">Add Model</a></li>			
		</ul>
		<div style="margin-left:25%;padding:1px 16px;height:1000px;">
			<h1>CAR INVENTORY MANAGEMENT</h1>
			<form onSubmit="add_manufacture(); return false;" style="font-size: 20px;">
				Manufacture Name * : 
				<input type="text" name="manufacture" id="manufacture" placeholder="Manufacture Name" />
				<button name="submit" id="submit" value="submit">Submit</button>
				<br /><span style="font-size: 12px;color: red;">*Field marks are important</span>
			</form>
		</div>
	</body>
</html>