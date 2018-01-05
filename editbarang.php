<?php
$conn=mysqli_connect("localhost","root","","knalpotjaya");
	if(!$conn){
	die("connection failed :".mysqli_connect_error());
	}
	
	$id=$_REQUEST['id'];
	$query="SELECT*FROM barang WHERE kd_barang='$id'";
	$hasil=mysqli_query($conn,$query);
	$data=mysqli_fetch_array($hasil);
	
if(isset($_POST['submit'])){
	$nobarang=$_POST['nobarang'];
	$namabarang=$_POST['namabarang'];
	$jumlah=$_POST['jumlah'];
	$harga=$_POST['harga'];
	
	$query="UPDATE barang SET kd_barang='$nobarang',nama_barang='$namabarang',
	jumlah_barang='$jumlah',harga_barang='$harga' WHERE kd_barang='$nobarang'" 
	or die(mysql_error());
	$hasil=mysqli_query($conn,$query);
	
	if($hasil){
		echo"<script>alert('data berhasil disimpan');</script>";
		echo"<script>window.location.href='databarang'</script>";
	}else{
		echo mysqli_error($conn);
	}
}	
	
?>
<html>
<head><title>PT.Knalpot Jaya - Edit Barang</title>
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
	<h3 class="w3-text-red"><b>Edit Barang</b></h3>
		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">	
		
<div class="w3-row-padding" style="margin:0 -16px 8px -16px">

	<div class="w3-col s12 m7">
		<label class="w3-text-red">No Barang</label>
			<input class="w3-input w3-border w3-light-grey" name="nobarang" 
			value="<?php echo $data['kd_barang']; ?>" type="text" readonly>
	</div>
	
	<div class="w3-col s12 m7">
		<label class="w3-text-red">Nama Barang</label>
			<input class="w3-input w3-border w3-light-grey" name="namabarang" 
			value="<?php echo $data['nama_barang'];?>"type="text">
	</div>
	
	<div class="w3-col s12 m7">	
	<label class="w3-text-red">Jumlah</label>
		<input class="w3-input w3-border w3-light-grey" name="jumlah" 
		value="<?php echo $data['jumlah_barang']; ?>"type="text">
	</div>
  
	<div class="w3-col s12 m7">	
	<label class="w3-text-red">Harga</label>
		<input class="w3-input w3-border w3-light-grey" name="harga" 
		value="<?php echo $data['harga_barang'];?>"type="text">
	</div>
</div>
  <button type="submit" name="submit" class="w3-btn w3-red w3-center w3-section"><i class="fa fa-paper-plane"></i>Simpan</button>
  <a href="databarang" class="w3-btn w3-red w3-center w3-section"><i class="fa fa-paper-plane"></i>Batal</a><br>
  </form>
</div>
</div>
</div>