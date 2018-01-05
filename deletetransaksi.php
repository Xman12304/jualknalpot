<?php
session_start();
$conn=mysqli_connect("localhost","root","","knalpotjaya");
	if(!$conn){
	die("connection failed :".mysqli_connect_error());
	}

$id = $_REQUEST['id'];
$query = "DELETE FROM keranjang WHERE kd_keranjang='$id'";
$result = mysqli_query($conn,$query);
unset($_SESSION['jumlah']);

if($result){
	//session_start();
	$query=mysqli_query($conn,"SELECT SUM(harga_satuan*jml_beli)as jmltotal FROM keranjang");
			while($data=mysqli_fetch_array($query)){	
				$total=$data['jmltotal'];
				$hargapasang='300.000';
				$_SESSION['jumlah']=$total+$hargapasang;
	echo"<script>alert('data berhasil dihapus');
	window.location='transaksi2.php';</script>";
	}
}	
else{
echo"<script>alert(data gagal dihapus');";
}
?>