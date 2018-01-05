<?php
$conn=mysqli_connect("localhost","root","","knalpotjaya");
	if(!$conn){
	die("connection failed :".mysqli_connect_error());
	}
	
	$id=$_GET['id'];
	$query="SELECT*FROM pegawai WHERE kd_pegawai='$id'";
	$hasil=mysqli_query($conn,$query);
	$data=mysqli_fetch_array($hasil);
	
if(isset($_POST['submit'])){
	$nopegawai=$_POST['nopegawai'];
	$namapegawai=$_POST['namapegawai'];
	$alamat=$_POST['alamat'];
	
	$query="UPDATE pegawai SET kd_pegawai='$nopegawai',namapegawai='$namapegawai',
	alamat='$alamat' WHERE kd_pegawai='$nopegawai'" 
	or die(mysql_error());
	$hasil=mysqli_query($conn,$query);
	
	if($hasil){
		echo"<script>alert('data berhasil disimpan');</script>";
		echo"<script>window.location.href='datapegawai'</script>";
	}else{
		echo"<h1>oops error</h1>";
	}
}	
	
?>
<html>
<head><title>PT.Knalpot Jaya - Edit Pegawai</title>
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
	<h3 class="w3-text-red"><b>Edit Pegawai</b></h3>
		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">	
		
<div class="w3-row-padding" style="margin:0 -16px 8px -16px">

	<div class="w3-col s12 m7">
		<label class="w3-text-red">No Pegawai</label>
			<input class="w3-input w3-border w3-light-grey" name="nopegawai" 
			value="<?php echo $data['kd_pegawai']; ?>" type="text" readonly>
	</div>
	
	<div class="w3-col s12 m7">
		<label class="w3-text-red">Nama Pegawai</label>
			<input class="w3-input w3-border w3-light-grey" name="namapegawai" 
			value="<?php echo $data['namapegawai'];?>"type="text">
	</div>
	
	<div class="w3-col s12 m7">	
	<label class="w3-text-red">alamat</label>
		<input class="w3-input w3-border w3-light-grey" name="alamat" 
		value="<?php echo $data['alamat']; ?>"type="text">
	</div>
  
</div>
  <button type="submit" name="submit" class="w3-btn w3-red w3-center w3-section"><i class="fa fa-paper-plane"></i>Simpan</button>
  <a href="datapegawai" class="w3-btn w3-red w3-center w3-section"><i class="fa fa-paper-plane"></i>Batal</a><br>
  </form>
</div>
</div>
</div>