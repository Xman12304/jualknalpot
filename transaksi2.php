<?php

error_reporting(E_ALL ^(E_NOTICE | E_WARNING));
session_start();
//koneksi
$conn=mysqli_connect("localhost","root","","knalpotjaya");
	if(!$conn){
	die("connection failed :".mysqli_connect_error());
	}

		//unique id
		$query="SELECT max(kd_pembelian) as maxkode FROM pembelian";
		$hasil=mysqli_query($conn,$query);
		$data=mysqli_fetch_array($hasil);
		$kode=$data['maxkode'];
		$nourut=substr($kode,3,3);
		$nourut++;
		$char="TR";
		$newid=$char.sprintf("%03s",$nourut);
		
		//unique id 2
		/*$query="SELECT max(no_pelanggan) as maxkode FROM pelanggan";
		$hasil=mysqli_query($conn,$query);
		$data=mysqli_fetch_array($hasil);
		$kode=$data['maxkode'];
		$nourut=substr($kode,3,3);
		$nourut++;
		$char="PL";
		$newid2=$char.sprintf("%03s",$nourut);*/
		
		
	//insert data pelanggan
	if(isset($_POST['submit'])){
		if($_POST['submit']=='input'){	
			
		$_SESSION['nopelanggan'];
		$_SESSION['namapelanggan'];
		$_SESSION['nopol'];
		$_SESSION['merkmobil'];	
		$nopembelian=$_POST['nopembelian'];
		$namabarang=$_POST['nama_barang'];
		$hargabarang=$_POST['harga_barang'];
		$jumlahbeli=$_POST['jumlahbeli'];
		$hargapasang='300.000';
		
		$query1="INSERT INTO keranjang 
		(kd_pelanggan,nama_barang,harga_satuan,harga_pemasangan,jml_beli,tgl_pembelian)VALUES
		('$_SESSION[nopelanggan]','$namabarang','$hargabarang',
		'$hargapasang','$jumlahbeli',CURDATE())";
		$hasil=mysqli_query($conn,$query1);
		
		if($hasil){
			
			$query=mysqli_query($conn,"SELECT SUM(harga_satuan*jml_beli)as jmltotal FROM 
			keranjang");
			while($data=mysqli_fetch_array($query)){	
				$total=$data['jmltotal'];
				$_SESSION['jumlah']=$total+$hargapasang;
				
				echo"<script>alert('data berhasil masuk keranjang');</script>";
				//echo mysqli_error();
				echo"<script>window.location.href='transaksi2'</script>";
			}
		}
		else{
			echo mysqli_error($conn);
		}
	}
	
	//save bukti transaksi
		if($_POST['submit']=='save'){
		
		$nopembelian=$_POST['nopembelian'];
		
		//insert transaksi
		/*$query1="INSERT INTO transaksi 
		(kd_pembelian,kd_pelanggan,nama_barang,harga_satuan,harga_pemasangan,jml_beli,tgl_pembelian)
		 VALUES
		('$nopembelian','$_SESSION[nopelanggan]','$namabarang','$hargabarang',
		'$hargapasang','$jumlahbeli',CURDATE())";
		$hasil=mysqli_query($conn,$query1);*/
		
		//insert transaksi
		$query1="INSERT INTO detil_pembelian 
		(kd_pelanggan,nama_barang,harga_satuan,harga_pemasangan,jml_beli,tgl_pembelian)
		SELECT kd_pelanggan,nama_barang,harga_satuan,harga_pemasangan,jml_beli,tgl_pembelian FROM
		 keranjang WHERE kd_pelanggan='$_SESSION[nopelanggan]'";
		$hasil=mysqli_query($conn,$query1);
		
		$query4="INSERT INTO pembelian(kd_pembelian,kd_pelanggan,tgl_pembelian)VALUES('$nopembelian',
		'$_SESSION[nopelanggan]',CURDATE())";
		$hasil=mysqli_query($conn,$query4);
		
		/*$query3="UPDATE transaksi 
		SET kd_pembelian='$nopembelian' WHERE kd_pelanggan='$_SESSION[nopelanggan]'";
		$hasil=mysqli_query($conn,$query3);*/
		
		//insert pelanggan
		$query2="INSERT INTO pelanggan (kd_pelanggan,nama_pelanggan,nopol_pelanggan,merk_mobil) VALUES 
		('$_SESSION[nopelanggan]','$_SESSION[namapelanggan]','$_SESSION[nopol]','$_SESSION[merkmobil]')";
		$hasil=mysqli_query($conn,$query2);
		
		//delete keranjang
		$query="DELETE FROM Keranjang";
		$hasil=mysqli_query($conn,$query);
		
		unset($_SESSION['jumlah']);
		unset($_SESSION['nopelanggan']);
		
		if($hasil){
			
			echo"<script>alert('data berhasil disimpan');</script>";
			echo"<script>window.location.href='transaksi2'</script>";
		}
	}
	}
	
	
	/*hitung ulang
	else if($_POST['submit']=="hitung"){
			$hargapasang=$_POST['hargapasang'];
			$query=mysqli_query($conn,"SELECT SUM(harga_satuan*jml_beli)as jmltotal FROM 
			transaksi");
			while($data=mysqli_fetch_array($query)){	
				$total=$data['jmltotal'];
				$jumlah=$total+$hargapasang;
		}
	}*/		
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

<script>
	function printContent(el){
		var restorepage = document.body.innerHTML;
		var printContent = document.getElementById(el).innerHTML;
		document.body.innerHTML = printContent;
		window.print();
		document.body.innerHTML = restorepage;
	}

	</script>

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

<!--form input pegawai-->	
<div class="w3-content w3-padding">		

	<h3 class="w3-text-red"><b>Entry Transaksi</b></h3>
	<form method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	<div class="w3-row-padding" style="margin:0 -16px 8px -16px">
	
	<div class="w3-half">
	<div class="w3-col s12 m7">
		<label class="w3-text-red">No Pembelian</label>
			<input class="w3-input w3-border w3-light-grey" name="nopembelian" value="<?php echo $newid; ?>"
			type="text" readonly>
	</div>
	</div>
	
  <div class="w3-half">
  <div class="w3-col s12 m7"> 
	<label class="w3-text-red">No Pelanggan</label>
		<input class="w3-input w3-border w3-light-grey" name="" value="<?php echo $_SESSION['nopelanggan']; ?>" 
		type="text" readonly>
  </div>
  </div>
  
  <div class="w3-half">
	<div class="w3-col s12 m7">  
	<label class="w3-text-red">Nama Barang</label>
		<?php
		//script autonumber harga
		$query="SELECT kd_barang,nama_barang,harga_barang FROM barang";
		$result=mysqli_query($conn,$query);
		$jsarray="var harga_barang = new Array();"; //javascript
		
		echo"<select class='w3-select w3-border' name='nama_barang' onchange='ChangeValue(this.value)'>
		<option value='pilih barang'>Pilih Barang</option>";
	
		while($data=mysqli_fetch_array($result)){
		echo"<option value='$data[kd_barang]'>
			$data[nama_barang]</option>";

		$jsarray.="harga_barang['$data[kd_barang]']={satu:'".addslashes($data['harga_barang'])."'};";
		//javascript	
		
		}
		echo"</select>";	
	?>
  </div>
  </div>
  
  <div class="w3-half">
  <div class="w3-col s12 m7">
	<label class="w3-text-red">Harga Satuan</label>
		<input class="w3-input w3-border w3-light-grey" name="harga_barang" id="harga_barang" type="text">
  </div>
  </div>
  
  <!--script autonumber harga-->
  <script type="text/javascript">
	<?php echo $jsarray; ?>
	function ChangeValue(id){
		document.getElementById('harga_barang').value = harga_barang[id].satu;
	};
	</script>
  
  <div class="w3-half">
  <div class="w3-col s12 m7">	
	<label class="w3-text-red">Harga Pemasangan</label>
		<input class="w3-input w3-border w3-light-grey" name="hargapasang" type="text" 
		value="<?php echo $hargapasang='300.000'; ?>" readonly>
  </div>
  
  </div>
  
  <div class="w3-half">
  <div class="w3-col s12 m7">	
	<label class="w3-text-red">Jumlah Beli</label>
		<input class="w3-input w3-border w3-light-grey" name="jumlahbeli" type="text">
  </div>
  
  </div>
  
  <div class="w3-half">
	<button type="submit" name="submit" value="input" 
	class="w3-btn w3-red w3-center w3-section"><i class="fa fa-paper-plane"></i>Input</button>
	<!--<button type="submit" name="submit" value="hitung" 
	class="w3-btn w3-red w3-center w3-section"><i class="fa fa-paper-plane"></i>Hitung Ulang</button>-->
	<a onclick="printContent('div1')" class="w3-btn w3-red w3-center w3-section">Print</a>
	<button type="submit" name="submit" value="save" 
	class="w3-btn w3-red w3-center w3-section"><i class="fa fa-paper-plane"></i>Save</button>
	<br>
  </div>
  
  
  </form>
  </div>
  
  <!--table pelanggan-->
  <div id="div1">	
  <h3 class="w3-text-red"><b>Transaksi</b></h3>
	<div class="w3-responsive">
	<table class="w3-table-all">
	<tr>
		<!--<th>No</th>-->
		<th>Kd Keranjang</th>
		<th>Kd Pelanggan</th>
		<!--<th>Kd Pegawai</th>-->
		<th>Nama Barang</th>
		<th>Harga Satuan</th>
		<th>Harga Pemasangan</th>
		<th>Jumlah Beli</th>
		<th>Tgl Pembelian</th>
		<th>Opsi</th>
	</tr>
	
		<?php
		
			//koneksi		
			$conn=mysqli_connect("localhost","root","","knalpotjaya");
			if(!$conn){
			die("connection failed :".mysqli_connect_error());
			}
			
			//mengambil data pegawai
			$query=mysqli_query($conn,"SELECT*FROM keranjang");
	
			if(mysqli_num_rows($query)==0){
				echo '<tr><td colspan="6">tidak ada data </td></tr>' ;
			}else{
			
			/*$no=1;*/
			while($data=mysqli_fetch_array($query)){
			echo "
				<tr>
				<td>$data[kd_keranjang]</td>
				<td>$data[kd_pelanggan]</td>
				<td>$data[nama_barang]</td>
				<td>$data[harga_satuan]</td>
				<td>$data[harga_pemasangan]</td>
				<td>$data[jml_beli]</td>
				<td>$data[tgl_pembelian]</td>
				<td><a class='w3-text-red' href='deletetransaksi.php?id=".$data['kd_keranjang']."' 
				onclick='return confirm(\"yakin ingin hapus ?\")'>Hapus</a></td>
				
				</tr>";
				
				/*$no++;*/
			}
			}
			/*echo"<td><td><h3>Total : Rp ".number_format($_SESSION['jumlah'],3)." </h3></td></td>";
			*/
		?>
	</tr>	
	</table>
	</div>
	
	<div class="w3-half">
	<div class="w3-col s12 m7">	
	<h3>Total : Rp <?php echo number_format($_SESSION['jumlah'],3) ?></h3>
	</div>
	</div>
	</div>
	
	</div>
</div>

<?php include"footer.html"?>