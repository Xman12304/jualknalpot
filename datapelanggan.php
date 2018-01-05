<?php
session_start();
//koneksi
$conn=mysqli_connect("localhost","root","","knalpotjaya");
	if(!$conn){
	die("connection failed :".mysqli_connect_error());
	}
	
	//unique id
		$query="SELECT max(kd_pelanggan) as maxkode FROM pelanggan";
		$hasil=mysqli_query($conn,$query);
		$data=mysqli_fetch_array($hasil);
		$kode=$data['maxkode'];
		$nourut=substr($kode,3,3);
		$nourut++;
		$char="PL";
		$newid=$char.sprintf("%03s",$nourut);	

//input data pelanggan		
if(isset($_POST['submit'])){	
$nopelanggan=$_POST['nopelanggan'];
$namapelanggan=$_POST['namapelanggan'];
$nopol=$_POST['nopol'];
$merkmobil=$_POST['merkmobil'];

//session
$_SESSION['nopelanggan']=$nopelanggan;
$_SESSION['namapelanggan']=$namapelanggan;
$_SESSION['nopol']=$nopol;
$_SESSION['merkmobil']=$merkmobil;

echo"<script>window.location.href='transaksi2'</script>";

/*$query="INSERT INTO pelanggan (no_pelanggan,nama_pelanggan,nopol_pelanggan,merk_mobil) VALUES 
('$_SESSION[nopelanggan]','$namapelanggan','$nopol','$merkmobil')";
$hasil=mysqli_query($conn,$query);

if($hasil){
	echo"<script>alert('data berhasil disimpan');</script>";
	echo"<script>window.location.href='transaksi'</script>";
}
else{
	echo"<h1>oops error</h1>";
}*/
}
?>

<html>
<head><title>PT.Knalpot Jaya - Penjualan</title>
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

<!--navbar-->
	<?php include"navbar.php"; ?>
	
	<div class="w3-content w3-container w3-padding-16 ">
	<?php
	//tanggal-bulan-tahun
		date_default_timezone_set("Asia/Jakarta");
		$tgl=date('D - j - M - Y');
		$jam=date('H:i:s');
		echo "Date : ".$tgl."<br>";
		echo "Time : ".$jam."<br>";
	?>	

<!--form input pelanggan-->	
<div class="w3-content w3-padding">	
<div class="w3-half w3-section">	
	<h3 class="w3-text-red"><b>Entry Pelanggan</b></h3>
		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">	
		
<div class="w3-row-padding" style="margin:0 -16px 8px -16px">

	<div class="w3-col s12 m7">
		<label class="w3-text-red">No Pelanggan</label>
			<input class="w3-input w3-border w3-light-grey" name="nopelanggan" value="<?php echo $newid; ?>"
			type="text" readonly>
	</div>
	
	<div class="w3-col s12 m7">
		<label class="w3-text-red">Nama Pelanggan</label>
			<input class="w3-input w3-border w3-light-grey" name="namapelanggan" type="text" required>
	</div>
	
	<div class="w3-col s12 m7">	
	<label class="w3-text-red">No.Polisi</label>
		<input class="w3-input w3-border w3-light-grey" name="nopol" type="text" required>
	</div>
  
	<div class="w3-col s12 m7">	
	<label class="w3-text-red">Merk Mobil</label>
		<input class="w3-input w3-border w3-light-grey" name="merkmobil" type="text" required>
	</div>
</div>
  <button type="submit" name="submit" class="w3-btn w3-red w3-center w3-section"><i class="fa fa-paper-plane"></i>Selanjutnya</button><br>
  </form>
</div>

  <!--table pelanggan-->
  <div class="w3-half w3-section">	
  <h3 class="w3-text-red"><b>Data Pelanggan</b></h3>
	<div class="w3-responsive">
	<table class="w3-table-all">
	<tr>
		<th>No</th>
		<th>No Pelanggan</th>
		<th>Nama Pelanggan</th>
		<th>No.Polisi</th>
		<th>Merk Mobil</th>
		<th>Opsi</th>
	</tr>
	<tr>
		<?php
			
			//koneksi
			$conn=mysqli_connect("localhost","root","","knalpotjaya");
			if(!$conn){
			die("connection failed :".mysqli_connect_error());
			}
			//mengambil data pelanggan
			$query=mysqli_query($conn,"SELECT*FROM pelanggan");
	
			if(mysqli_num_rows($query)==0){
				echo '<tr><td colspan="6">tidak ada data </td></tr>' ;
			}else{
			
			$no=1;
			while($data=mysqli_fetch_array($query)){
			echo "
				<tr>
				<td>$no</td>
				<td>$data[kd_pelanggan]</td>
				<td>$data[nama_pelanggan]</td>
				<td>$data[nopol_pelanggan]</td>
				<td>$data[merk_mobil]</td>
				<td><a class='w3-text-red' href='editpelanggan.php?id=".$data['kd_pelanggan']."'>Edit</a> 
				/ 
				<a class='w3-text-red' href='deletepelanggan.php?id=".$data['kd_pelanggan']."' 
				onclick='return confirm(\"yakin ingin hapus ?\")'>Hapus</a></td>
				
				</tr>";
			$no++;
			}
			}
			
		?>
	</tr>	
	</table>
	</div>
	</div>
	</div>
  </div>
</div>
</div>

<?php include"footer.html"?>