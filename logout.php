<?php

session_destroy();
echo"<h1>anda sudah logout</h1>";
header("location:index.php");
//echo"<script>window.location.href='index'</script>";

?>