<?php
$conn=mysqli_connect("localhost","root","","knalpotjaya");
	if(!$conn){
	die("connection failed :".mysqli_connect_error());
	}

$id = $_REQUEST['id'];
$query = "DELETE FROM barang WHERE kd_barang='$id'";
$result = mysqli_query($conn,$query);
if($result){
	echo"<script>alert('data berhasil dihapus');
	window.location='databarang.php';</script>";
}else{
echo"<script>alert(data gagal dihapus');";
}
?>