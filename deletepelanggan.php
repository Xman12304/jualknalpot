<?php
$conn=mysqli_connect("localhost","root","","knalpotjaya");
	if(!$conn){
	die("connection failed :".mysqli_connect_error());
	}

$id = $_REQUEST['id'];

//hapus data pelanggan
$query = "DELETE FROM pelanggan WHERE kd_pelanggan='$id'";
$result = mysqli_query($conn,$query);

//hapus data pelanggan pada tabel pembelian
$query = "DELETE FROM detil_pembelian WHERE kd_pelanggan='$id'";
$result = mysqli_query($conn,$query);

//hapus data pelanggan pada tabel pembelian
$query = "DELETE FROM pembelian WHERE kd_pelanggan='$id'";
$result = mysqli_query($conn,$query);

if($result){
	echo"<script>alert('data berhasil dihapus');
	window.location='datapelanggan.php';</script>";
}else{
echo"<script>alert(data gagal dihapus');";
}
?>