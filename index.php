<?php

$conn=mysqli_connect("localhost","root","","knalpotjaya");
	if(!$conn){
	die("connection failed :".mysqli_connect_error());
	}
	
if(isset($_POST['submit'])){	
$username=$_POST['username'];
$password=$_POST['password'];

/*$_SESSION['email']=$email;
$_SESSION['pass']=$password;*/

$query="SELECT*FROM login WHERE username='$username' AND password='$password'";
$hasil=mysqli_query($conn,$query);
$data=mysqli_fetch_array($hasil);

if($password==$data['password']){
	session_start();
	$_SESSION['username']=$data['username'];
	echo"<script>window.location.href='menu'</script>";
}
else echo"<h1>login gagal</h1>";
}

?>
<html>
<head><title>PT.Knalpot Jaya - Penjualan</title></head>
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

	<div class="w3-container w3-bar w3-red">
	<a href="index" class="w3-bar-item w3-button w3-xlarge w3-wide w3-text-white w3-right">PT.Knalpot Jaya</a>
	
	<!--<div class="w3-dropdown-click">
	<button class="w3-button w3-xlarge w3-text-red" onclick="myFunction()">Menu</button>
	<div id="demo" class="w3-dropdown-content w3-bar-block w3-card-2">
	<a href="signin" class="w3-bar-item w3-button w3-text-red">Masuk</a>
	<a href="signup" class="w3-bar-item w3-button w3-text-red">Daftar</a>
	<a href="about" class="w3-bar-item w3-button w3-text-red">Tentang Kami</a>
	</div>
	</diV>-->
	
	</div>

<!--form sign in-->
<div class="w3-content w3-container w3-padding-16 ">
<h2 class="w3-text-red">Masuk</h2>
  <p>Silahkan Login Untuk Masuk Ke Akun Anda</p>
  <div class="w3-content w3-container">
  <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
  <div class="w3-row-padding" style="margin:0 -16px 8px -16px">
  <div class="w3-col s12 m5">
  <label class="w3-text-red"><b>Username</b></label>
  <input class="w3-input w3-border" name="username" type="text" required>
  </div>
  <div class="w3-col s12 m5">	
  <label class="w3-text-red"><b>Password</b></label>
  <input class="w3-input w3-border" name="password" type="password" required>
  </div>
  </div>
  <button name="submit" type="submit" class="w3-btn w3-red w3-center w3-section"><i class="fa fa-paper-plane"></i>
  Masuk Akun</button><br>
  </form>
  </div>
</div>
</div>

<?php include"footer.html"; ?>