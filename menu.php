<html>
<head><title>PT.Knalpot Jaya - Penjualan</title>
<meta http-equiv="Content-Type" content="text/html"/>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3.css">
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif;}
body, html {
    height: 100%;
    color: #777;
    line-height: 1.8;
}
</style>
</head>
<body>

<div class="w3-main" id="main">
	
<!--navbar-->
	<?php include"navbar.php"; ?>
	
	<div class="w3-content w3-container w3-padding-16 ">
	<?php
		
		date_default_timezone_set("Asia/Jakarta");
		$tgl=date('D - j - M - Y');
		$jam=date('H:i:s');
		echo "Date : ".$tgl."<br>";
		echo "Time : ".$jam."<br>";
	?>	
		
	<?php
		session_start();
		echo"<br><div align='center'>";
			echo"<h4>Welcome, ".$_SESSION['username']." <br>
			Please Choose a Menu to Run Your Business</h4>";
		echo"</div>";
	?>

</div>
</div>
<?php include"footer.html"?>	