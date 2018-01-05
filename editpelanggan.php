<?php
$conn=mysqli_connect("localhost","root","","knalpotjaya");
	if(!$conn){
	die("connection failed :".mysqli_connect_error());
	}
	
	$id=$_GET['id'];
	$query="SELECT*FROM pelanggan WHERE kd_pelanggan='$id'";
	$hasil=mysqli_query($conn,$query);
	$data=mysqli_fetch_array($hasil);
	
if(isset($_POST['submit'])){
	$nopelanggan=$_POST['nopelanggan'];
	$namapelanggan=$_POST['namapelanggan'];
	$nopol=$_POST['nopol'];
	$merkmobil=$_POST['merkmobil'];
	
	$query="UPDATE pelanggan SET kd_pelanggan='$nopelanggan',nama_pelanggan='$namapelanggan',
	nopol_pelanggan='$nopol',merk_mobil='$merkmobil' WHERE kd_pelanggan='$nopelanggan'" 
	or die(mysql_error());
	$hasil=mysqli_query($conn,$query);
	
	if($hasil){
		echo"<script>alert('data berhasil disimpan');</script>";
		echo"<script>window.location.href='datapelanggan'</script>";
	}else{
		echo"<h1>oops error</h1>";
	}
}	
	
?>
<html>
<head><title>PT.Knalpot Jaya - Edit Pelanggan</title>
<meta http-equiv="Content-Type" content="text/html"/>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
	<div class="w3-container w3-bar w3-white">
	<a href="index" class="w3-bar-item w3-button w3-xlarge w3-wide w3-text-red w3-right">PT.Knalpot Jaya</a>
	</div>
<div class="w3-container w3-content w3-padding">	
<!--input data-->
<div class="w3-half w3-section">	
	<h3 class="w3-text-red"><b>Edit Pelanggan</b></h3>
		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">	
		
<div class="w3-row-padding" style="margin:0 -16px 8px -16px">

	<div class="w3-col s12 m7">
		<label class="w3-text-red">No Pelanggan</label>
			<input class="w3-input w3-border w3-light-grey" name="nopelanggan" 
			value="<?php echo $data['kd_pelanggan']; ?>" type="text" readonly>
	</div>
	
	<div class="w3-col s12 m7">
		<label class="w3-text-red">Nama Pelanggan</label>
			<input class="w3-input w3-border w3-light-grey" name="namapelanggan" 
			value="<?php echo $data['nama_pelanggan'];?>"type="text">
	</div>
	
	<div class="w3-col s12 m7">	
	<label class="w3-text-red">No.Polisi</label>
		<input class="w3-input w3-border w3-light-grey" name="nopol" 
		value="<?php echo $data['nopol_pelanggan']; ?>"type="text">
	</div>
  
	<div class="w3-col s12 m7">	
	<label class="w3-text-red">Merk Mobil</label>
		<input class="w3-input w3-border w3-light-grey" name="merkmobil" 
		value="<?php echo $data['merk_mobil'];?>"type="text">
	</div>
</div>
  <button type="submit" name="submit" class="w3-btn w3-red w3-center w3-section"><i class="fa fa-paper-plane"></i>Simpan</button>
  <a href="datapelanggan" class="w3-btn w3-red w3-center w3-section"><i class="fa fa-paper-plane"></i>Batal</a><br>
  </form>
</div>
</div>
</div>